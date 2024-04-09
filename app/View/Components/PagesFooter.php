<?php

namespace App\View\Components;

use App\Models\SocialMedia;
use Illuminate\View\Component;

class PagesFooter extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $social_media;

    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('pages.components.pages-footer');
    }
}
