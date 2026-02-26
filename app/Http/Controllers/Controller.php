<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    // deklarasi variabel global session
    public $session;

    public function __construct()
    {
        // untuk session user
        $this->session = Auth::user();
    }
}
