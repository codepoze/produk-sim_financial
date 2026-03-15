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
                "`[kategori] [nominal] [keterangan]`\n\n" .
                "Contoh:\n" .
                "`makan 20000 bakso`\n" .
                "`gaji 5000000 gaji januari`\n\n" .
                "*Command tersedia:*\n" .
                "/categories → lihat daftar kategori\n",
        ]);
    }
}
