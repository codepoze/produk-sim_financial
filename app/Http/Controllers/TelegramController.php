<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
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

    public function handleWebhook() {
        $update = Telegram::getWebhookUpdate();

        $chatId = $update->getMessage()->getChat()->getId();
        $text   = $update->getMessage()->getText();

        if ($text === '/start') {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text'    => 'Halo! Selamat datang di bot saya 👋',
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text'    => 'Maaf, saya tidak mengerti pesan Anda.',
            ]);
        }

        return response()->json(['ok' => true]);
    }
    
    
}
