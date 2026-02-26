<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Product;
use App\Models\Testimony;
use App\Models\Visitors;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index()
    {
        return Template::pages(__('menu.home'), 'home', 'view');
    }
}
