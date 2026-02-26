<?php

namespace App\View\Components;

use App\Models\Type;
use Illuminate\View\Component;

class PagesNavbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;

    public function __construct()
    {
        // untuk produk
        $this->type = Type::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('pages.components.pages-navbar');
    }
}
