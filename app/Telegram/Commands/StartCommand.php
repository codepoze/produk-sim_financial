<?php

namespace App\Telegram\Commands;

use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand
{
    public function handle(int $chatId, User $user): void
    {
        Telegram::sendMessage([
            'chat_id'    => $chatId,
            'parse_mode' => 'Markdown',
            'text'       => "👋 Halo, *{$user->nama}*!\n\n" .
                "Selamat datang di *MoneyLog Bot* 💰\n\n" .
                "*Format catat transaksi:*\n" .
                "`[kategori], [nominal], [keterangan]`\n" .
                "`[kategori], [nominal], [keterangan], [tanggal]`\n\n" .
                "Contoh:\n" .
                "`makan, 20.000, bakso`\n" .
                "`House Bills, 100.000, listrik, 2024-01-15`\n\n" .
                "_Tanggal opsional format: YYYY-MM-DD_\n\n" .
                "*Command tersedia:*\n" .
                "/categories → lihat daftar kategori\n",
        ]);
    }
}
