<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;

Route::get('/telegram/setup', [TelegramController::class, 'setupWebhook']);
Route::get('/telegram/delete', [TelegramController::class, 'deleteWebhook']);
Route::get('/telegram/info', [TelegramController::class, 'getWebhookInfo']);
Route::get('/telegram/message', [TelegramController::class, 'sendMessage']);
Route::post('/telegram/webhook', [TelegramController::class, 'handleWebhook']);