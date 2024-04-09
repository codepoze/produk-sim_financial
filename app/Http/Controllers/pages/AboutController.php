<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Libraries\Template;

class AboutController extends Controller
{
    public function index()
    {
        return Template::pages(__('menu.about'), 'about', 'view');
    }
}
