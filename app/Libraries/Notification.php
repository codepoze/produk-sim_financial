<?php

/**
 * Laravel Dompdf Library
 *
 * Generate PDF's from HTML in Laravel
 *
 * @packge     Laravel
 * @subpackage Libraries
 * @category   Libraries
 * @author     Alan Saputra Lengkoan
 * @license    MIT License
 */

namespace App\Libraries;

use App\Models\Notification as ModelsNotification;

class Notification
{
    // untuk cetak pdf
    public static function send($id, $route, $text)
    {
        $notification         = new ModelsNotification();
        $notification->id     = $id;
        $notification->route  = $route;
        $notification->text   = $text;
        $notification->status = 'unread'; // 'read' atau 'unread
        $notification->save();
    }
}
