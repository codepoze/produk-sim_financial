<?php

namespace App\Telegram\Handlers;

use App\Models\Category;
use App\Models\Money;
use App\Models\User;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;

class TransactionHandler
{
    public function handle(string $text, int $chatId, User $user): void
    {
        $lines    = explode("\n", $text);
        $berhasil = [];
        $gagal    = [];

        foreach ($lines as $line) {
            $line  = trim($line);

            // ← limit 4 agar date bisa masuk parts[3]
            $parts = array_map('trim', explode(',', $line, 4));

            if (count($parts) >= 2 && $this->isValidNominal($parts[1])) {
                $namaKategori = strtolower($parts[0]);
                $nominal      = $this->parseNominal($parts[1]);
                $keterangan   = $parts[2] ?? '-';

                // Date optional — default hari ini
                if (isset($parts[3])) {
                    $date = $this->parseDate($parts[3]);
                    if ($date === null) {
                        $gagal[] = "❌ `{$line}` → format tanggal salah, gunakan `YYYY-MM-DD`\nContoh: `2025-01-15`";
                        continue;
                    }
                } else {
                    $date = today();
                }

                $category = Category::where('id_users', $user->id_users)
                    ->whereRaw('LOWER(name) = ?', [$namaKategori])
                    ->first();

                if (!$category) {
                    $gagal[] = "❌ `{$line}` → kategori *{$namaKategori}* tidak ditemukan";
                    continue;
                }

                Money::create([
                    'id_users'    => $user->id_users,
                    'id_category' => $category->id_category,
                    'amount'      => $nominal,
                    'description' => $keterangan,
                    'date'        => $date,
                ]);

                $type       = $category->type === 'income' ? '💚' : '🔴';
                $dateLabel  = $date->isToday() ? 'hari ini' : $date->format('d/m/Y');
                $berhasil[] = "{$type} *{$namaKategori}* - " . rupiah($nominal) . " ({$keterangan}) 📅 {$dateLabel}";
            } else {
                if (!empty($line)) {
                    $gagal[] = "❌ `{$line}` → format salah";
                }
            }
        }

        $reply = $this->buildReply($berhasil, $gagal, $user);

        Telegram::sendMessage([
            'chat_id'    => $chatId,
            'text'       => $reply,
            'parse_mode' => 'Markdown',
        ]);
    }

    private function buildReply(array $berhasil, array $gagal, User $user): string
    {
        $reply = '';

        if (!empty($berhasil)) {
            $totalExpense = Money::where('id_users', $user->id_users)
                ->whereDate('date', today())
                ->whereHas('toCategory', fn($q) => $q->where('type', 'expense'))
                ->sum('amount');

            $totalIncome = Money::where('id_users', $user->id_users)
                ->whereDate('date', today())
                ->whereHas('toCategory', fn($q) => $q->where('type', 'income'))
                ->sum('amount');

            $saldo     = $totalIncome - $totalExpense;
            $saldoIcon = $saldo >= 0 ? '🟢' : '🔴';

            $reply .= "📋 *Catatan Tersimpan:*\n";
            $reply .= implode("\n", $berhasil);
            $reply .= "\n\n📊 *Ringkasan hari ini:*\n";

            if ($totalIncome > 0) {
                $reply .= "💚 Pemasukan : " . rupiah($totalIncome) . "\n";
            }

            if ($totalExpense > 0) {
                $reply .= "🔴 Pengeluaran: " . rupiah($totalExpense) . "\n";
            }

            $reply .= "{$saldoIcon} *Saldo hari ini: " . rupiah(abs($saldo)) . "*";

            if ($saldo < 0) {
                $reply .= " _(minus)_";
            }
        }

        if (!empty($gagal)) {
            $reply .= "\n\n⚠️ *Gagal disimpan:*\n";
            $reply .= implode("\n", $gagal);
            $reply .= "\n\n_Ketik /categories untuk melihat daftar kategori_";
        }

        return $reply;
    }

    private function isValidNominal(string $value): bool
    {
        $clean = str_replace('.', '', $value);
        $clean = str_replace(',', '.', $clean);

        return is_numeric($clean) && (float) $clean > 0;
    }

    private function parseNominal(string $value): float
    {
        $value = str_replace('.', '', $value);
        $value = preg_replace('/[^0-9,]/', '', $value);
        $value = str_replace(',', '.', $value);

        return (float) $value;
    }

    private function parseDate(string $value): ?Carbon
    {
        $value = trim($value);

        // Harus tepat format YYYY-MM-DD
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            return null;
        }

        try {
            $date = Carbon::createFromFormat('Y-m-d', $value);

            // Double check hasil parse harus sama persis dengan input
            if ($date && $date->format('Y-m-d') === $value) {
                return $date;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
