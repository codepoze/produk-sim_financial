<?php

namespace App\Telegram\Handlers;

use App\Models\Category;
use App\Models\Money;
use App\Models\User;
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
            $parts = explode(' ', $line, 3);

            if (count($parts) >= 2 && is_numeric($parts[1])) {
                $namaKategori = strtolower($parts[0]);
                $nominal      = (float) $parts[1];
                $keterangan   = $parts[2] ?? '-';

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
                    'name'        => $keterangan,
                    'amount'      => $nominal,
                    'description' => $keterangan,
                    'date'        => now(),
                ]);

                $type       = $category->type === 'income' ? '💚' : '🔴';
                $berhasil[] = "{$type} *{$namaKategori}* - Rp " . number_format($nominal, 0, ',', '.') . " ({$keterangan})";
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
                $reply .= "💚 Pemasukan : Rp " . number_format($totalIncome, 0, ',', '.') . "\n";
            }

            if ($totalExpense > 0) {
                $reply .= "🔴 Pengeluaran: Rp " . number_format($totalExpense, 0, ',', '.') . "\n";
            }

            $reply .= "{$saldoIcon} *Saldo hari ini: Rp " . number_format(abs($saldo), 0, ',', '.') . "*";

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
}
