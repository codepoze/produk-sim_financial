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
                'chat_id' => $chatId,
                'text'    => "📂 Kamu belum memiliki kategori.\n\nSilakan tambahkan kategori di aplikasi MoneyLog.",
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

        Telegram::sendMessage([
            'chat_id'    => $chatId,
            'text'       => $text,
            'parse_mode' => 'Markdown',
        ]);
    }
}
