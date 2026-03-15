<?php

namespace App\Telegram\Commands;

use App\Models\Money;
use App\Models\User;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;

class ReportCommand
{
    public function handle(string $text, int $chatId, User $user): void
    {
        $parts = explode(' ', $text, 2);
        $param = trim($parts[1] ?? '');

        // Tentukan periode
        if (empty($param)) {
            // Default → bulan ini
            $this->reportBulanan(Carbon::now(), $chatId, $user);

        } elseif (preg_match('/^\d{4}-\d{2}$/', $param)) {
            // Format YYYY-MM → laporan bulanan
            $date = Carbon::createFromFormat('Y-m', $param);

            if (!$date || $date->format('Y-m') !== $param) {
                $this->sendError($chatId);
                return;
            }

            $this->reportBulanan($date, $chatId, $user);

        } elseif (preg_match('/^\d{4}$/', $param)) {
            // Format YYYY → laporan tahunan
            $date = Carbon::createFromFormat('Y', $param);

            if (!$date || $date->format('Y') !== $param) {
                $this->sendError($chatId);
                return;
            }

            $this->reportTahunan($date, $chatId, $user);

        } else {
            // Format tidak dikenali
            Telegram::sendMessage([
                'chat_id'    => $chatId,
                'parse_mode' => 'Markdown',
                'text'       => "⚠️ Format tidak dikenali!\n\n" .
                                "*Gunakan salah satu:*\n" .
                                "`/report` → bulan ini\n" .
                                "`/report 2026-01` → bulan tertentu\n" .
                                "`/report 2026` → tahunan\n",
            ]);
        }
    }

    // ─── Laporan Bulanan ─────────────────────────────────────────
    private function reportBulanan(Carbon $date, int $chatId, User $user): void
    {
        $startDate = $date->copy()->startOfMonth();
        $endDate   = $date->copy()->endOfMonth();
        $periode   = $date->translatedFormat('F Y');

        [$totalIncome, $totalExpense] = $this->getTotal($user, $startDate, $endDate);

        if ($totalIncome == 0 && $totalExpense == 0) {
            $this->sendKosong($chatId, $periode);
            return;
        }

        $this->sendReply($chatId, $periode, '🗓', $totalIncome, $totalExpense);
    }

    // ─── Laporan Tahunan ─────────────────────────────────────────
    private function reportTahunan(Carbon $date, int $chatId, User $user): void
    {
        $startDate = $date->copy()->startOfYear();
        $endDate   = $date->copy()->endOfYear();
        $periode   = $date->format('Y');

        [$totalIncome, $totalExpense] = $this->getTotal($user, $startDate, $endDate);

        if ($totalIncome == 0 && $totalExpense == 0) {
            $this->sendKosong($chatId, $periode);
            return;
        }

        // Breakdown per bulan
        $breakdown = $this->getBreakdownPerBulan($user, $date);

        $this->sendReply($chatId, $periode, '📅', $totalIncome, $totalExpense, $breakdown);
    }

    // ─── Ambil Total Income & Expense ────────────────────────────
    private function getTotal(User $user, Carbon $start, Carbon $end): array
    {
        $totalIncome = Money::where('id_users', $user->id_users)
            ->whereBetween('date', [$start, $end])
            ->whereHas('toCategory', fn($q) => $q->where('type', 'income'))
            ->sum('amount');

        $totalExpense = Money::where('id_users', $user->id_users)
            ->whereBetween('date', [$start, $end])
            ->whereHas('toCategory', fn($q) => $q->where('type', 'expense'))
            ->sum('amount');

        return [(float) $totalIncome, (float) $totalExpense];
    }

    // ─── Breakdown Per Bulan (untuk tahunan) ─────────────────────
    private function getBreakdownPerBulan(User $user, Carbon $date): string
    {
        $breakdown = '';

        for ($m = 1; $m <= 12; $m++) {
            $bulan      = $date->copy()->month($m);
            $startDate  = $bulan->copy()->startOfMonth();
            $endDate    = $bulan->copy()->endOfMonth();

            [$income, $expense] = $this->getTotal($user, $startDate, $endDate);

            if ($income == 0 && $expense == 0) continue;

            $saldo     = $income - $expense;
            $saldoIcon = $saldo >= 0 ? '🟢' : '🔴';
            $namaBulan = $bulan->translatedFormat('F');

            $breakdown .= "\n📌 *{$namaBulan}*\n";

            if ($income > 0) {
                $breakdown .= "  💚 " . rupiah($income) . "\n";
            }

            if ($expense > 0) {
                $breakdown .= "  🔴 " . rupiah($expense) . "\n";
            }

            $breakdown .= "  {$saldoIcon} " . rupiah(abs($saldo));
            $breakdown .= $saldo < 0 ? " _(minus)_\n" : "\n";
        }

        return $breakdown;
    }

    // ─── Kirim Balasan ───────────────────────────────────────────
    private function sendReply(int $chatId, string $periode, string $icon, float $totalIncome, float $totalExpense, string $breakdown = ''): void
    {
        $saldo     = $totalIncome - $totalExpense;
        $saldoIcon = $saldo >= 0 ? '🟢' : '🔴';
        $saldoNote = $saldo < 0 ? ' _(minus)_' : '';

        $reply  = "📊 *Laporan Keuangan*\n";
        $reply .= "{$icon} _{$periode}_\n";
        $reply .= str_repeat('─', 25) . "\n";

        // Breakdown per bulan (khusus tahunan)
        if (!empty($breakdown)) {
            $reply .= $breakdown;
            $reply .= str_repeat('─', 25) . "\n";
            $reply .= "*Total {$periode}*\n";
        }

        if ($totalIncome > 0) {
            $reply .= "💚 Pemasukan : " . rupiah($totalIncome) . "\n";
        }

        if ($totalExpense > 0) {
            $reply .= "🔴 Pengeluaran: " . rupiah($totalExpense) . "\n";
        }

        $reply .= str_repeat('─', 25) . "\n";
        $reply .= "{$saldoIcon} *Saldo: " . rupiah(abs($saldo)) . "*{$saldoNote}";

        Telegram::sendMessage([
            'chat_id'    => $chatId,
            'parse_mode' => 'Markdown',
            'text'       => $reply,
        ]);
    }

    // ─── Kirim Kosong ────────────────────────────────────────────
    private function sendKosong(int $chatId, string $periode): void
    {
        Telegram::sendMessage([
            'chat_id'    => $chatId,
            'parse_mode' => 'Markdown',
            'text'       => "📊 *Laporan {$periode}*\n\n_Tidak ada transaksi._",
        ]);
    }

    // ─── Kirim Error Format ──────────────────────────────────────
    private function sendError(int $chatId): void
    {
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text'    => "❌ Periode tidak valid!",
        ]);
    }
}