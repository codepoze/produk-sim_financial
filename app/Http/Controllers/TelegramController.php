<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Telegram\Commands\CategoriesCommand;
use App\Telegram\Commands\LinkCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Handlers\TransactionHandler;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function handleWebhook()
    {
        $update  = Telegram::getWebhookUpdate();
        $message = $update->getMessage();

        if (!$message) return response()->json(['ok' => true]);

        $chatId = $message->getChat()->getId();
        $text   = trim($message->getText());

        // /link tidak butuh auth
        if (str_starts_with($text, '/link')) {
            (new LinkCommand)->handle($text, $chatId);
            return response()->json(['ok' => true]);
        }

        $user = User::where('telegram_chat_id', $chatId)->first();

        if (!$user) {
            Telegram::sendMessage([
                'chat_id'    => $chatId,
                'parse_mode' => 'Markdown',
                'text'       => "❌ Akun kamu belum terhubung.\n\n" .
                    "Silakan login di *MoneyLog*, lalu generate token dan kirim:\n`/link TOKEN`",
            ]);
            return response()->json(['ok' => true]);
        }

        // Handle command
        if (str_starts_with($text, '/')) {
            $command = strtolower(explode(' ', $text)[0]);

            match ($command) {
                '/start'      => (new StartCommand)->handle($chatId, $user),
                '/categories' => (new CategoriesCommand)->handle($chatId, $user),
                default       => Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text'    => "❓ Command tidak dikenali. Ketik /start untuk melihat panduan.",
                ]),
            };

            return response()->json(['ok' => true]);
        }

        // Handle transaksi
        (new TransactionHandler)->handle($text, $chatId, $user);

        return response()->json(['ok' => true]);
    }

    public function setupWebhook()
    {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);

        return response()->json($response);
    }

    public function deleteWebhook()
    {
        $response = Telegram::deleteWebhook();

        return response()->json($response);
    }

    public function getWebhookInfo()
    {
        $response = Telegram::getWebhookInfo();

        return response()->json($response);
    }
}
