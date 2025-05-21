<?php

namespace App\View\Components;

use Closure;
use App\Models\Shop;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AdminNav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $shop = Shop::first();

        return view('components.navigations.admin-nav', compact('shop'));
    }
}
