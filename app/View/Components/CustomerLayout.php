<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class CustomerLayout extends Component
{


    public function __construct()
    {
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.customer');
    }
}
