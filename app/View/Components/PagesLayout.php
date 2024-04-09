<?php

namespace App\View\Components;

use App\Models\SocialMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class PagesLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;

    public function __construct($title = null)
    {
        // untuk judul halaman
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('pages.layouts.pages-layout');
    }
}
