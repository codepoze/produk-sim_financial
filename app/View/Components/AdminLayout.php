<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Route;

class AdminLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $breadcrumb;

    public function __construct($title = null)
    {
        // untuk judul halaman
        $this->title = $title;
        // untuk breadcrumb
        $this->breadcrumb = Breadcrumbs::render(Route::currentRouteName());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.layouts.admin-layout');
    }
}
