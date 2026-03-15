<?php

namespace App\Telegram\Commands;

use App\Models\Category;
use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class CategoriesCommand
{
    public function handle(int $chatId, User $user): void
    {
        $categories = Category::where('id_users', $user->id_users)
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        if ($categories->isEmpty()) {
            Telegram::sendMessage([
                'chat_id'    => $chatId,
                'parse_mode' => 'Markdown',
                'text'       => "📂 Kamu belum memiliki kategori.\n\n" .
                    "Silakan tambahkan kategori di aplikasi MoneyLog.",
            ]);
            return;
        }

        $income  = $categories->where('type', 'income');
        $expense = $categories->where('type', 'expense');

        $text = "📂 *Kategori MoneyLog*\n\n";

        if ($income->isNotEmpty()) {
            $text .= "💚 *Pemasukan:*\n";
            foreach ($income as $cat) {
                $text .= "  - {$cat->name}\n";
            }
        }

        if ($expense->isNotEmpty()) {
            $text .= "\n🔴 *Pengeluaran:*\n";
            foreach ($expense as $cat) {
                $text .= "  - {$cat->name}\n";
            }
        }

        $text .= "\n\n💡 *Format input transaksi:*\n";
        $text .= "`[kategori], [nominal], [keterangan]`\n";
        $text .= "`[kategori], [nominal], [keterangan], [tanggal]`\n\n";
        $text .= "📝 *Contoh:*\n";

        if ($income->isNotEmpty()) {
            $contohIncome = $income->first()->name;
            $text .= "`{$contohIncome}, 5.000.000, gaji januari`\n";
            $text .= "`{$contohIncome}, 5.000.000, gaji januari, 2024-01-01`\n";
        }

        if ($expense->isNotEmpty()) {
            $contohExpense = $expense->first()->name;
            $text .= "`{$contohExpense}, 20.000, keterangan`\n";
            $text .= "`{$contohExpense}, 20.000, keterangan, 2024-01-15`\n";
        }

        $text .= "\n_Tanggal bersifat opsional, default hari ini._\n";
        $text .= "_Bisa kirim lebih dari 1 baris sekaligus!_";

        Telegram::sendMessage([
            'chat_id'    => $chatId,
            'text'       => $text,
            'parse_mode' => 'Markdown',
        ]);
    }
}
