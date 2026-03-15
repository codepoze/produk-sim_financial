<?php

namespace App\Telegram\Commands;

use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class LinkCommand
{
    public function handle(string $text, int $chatId): void
    {
        $parts = explode(' ', $text);
        $token = $parts[1] ?? null;

        if (!$token) {
            Telegram::sendMessage([
                'chat_id'    => $chatId,
                'parse_mode' => 'Markdown',
                'text'       => "⚠️ Format salah!\n\nGunakan:\n`/link TOKEN`\n\nToken bisa didapatkan di aplikasi MoneyLog.",
            ]);
            return;
        }

        $user = User::where('telegram_token', strtoupper($token))->first();

        if (!$user) {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text'    => "❌ Token tidak valid! Silakan generate token baru di aplikasi MoneyLog.",
            ]);
            return;
        }

        if (now()->isAfter($user->telegram_token_expired_at)) {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text'    => "⏰ Token sudah expired! Silakan generate token baru di aplikasi MoneyLog.",
            ]);
            return;
        }

        if (User::where('telegram_chat_id', $chatId)->exists()) {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text'    => "⚠️ Akun Telegram ini sudah terhubung ke akun MoneyLog lain.",
            ]);
            return;
        }

        $user->update([
            'telegram_chat_id'          => $chatId,
            'telegram_token'            => null,
            'telegram_token_expired_at' => null,
        ]);

        Telegram::sendMessage([
            'chat_id'    => $chatId,
            'parse_mode' => 'Markdown',
            'text'       => "✅ *Akun berhasil terhubung!*\n\n" .
                "Halo *{$user->name}*, sekarang kamu bisa mencatat keuangan via bot ini.\n\n" .
                "Ketik /start untuk melihat panduan.",
        ]);
    }
}
