<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public $sidebar;
    public $navbar;

    public function __construct()
    {

        $this->navbar = [
            [
                'title' => 'Apps',
                'type' => 'dropdown',
                'app_list_two_side'=>false,
                'quick_links' => [
                    ['title' => 'title 1', 'route' => '#',],
                    ['title' => 'title 2', 'route' => '#',],
                ],

                'app_lists_left' => [
                    ['title' => 'title 1', 'sub-title' => 'sub title2', 'icon_links' => '#', 'route' => '#',],
                ],
                'app_lists_right' => [
                    ['title' => 'title 1', 'sub-title' => 'sub title2', 'icon_links' => '#', 'route' => '#',],
                ]
            ],
            ['title'=>'Chat','type'=>'link', 'route'=>'#',],
            ['title'=>'Calendar','type'=>'link', 'route'=>'#',],
            ['title'=>'Email','type'=>'link', 'route'=>'#',],

        ];

        $this->sidebar = [
            [
                'title' => 'Home',
                'lists' => [
                    ['title' => 'Dashboard', 'type' => 'link', 'route' => '#', 'icon' => '<i class="ti ti-brand-chrome  text-xl flex-shrink-0"></i> '],
                    [
                        'title' => 'Form Elements', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-brand-chrome  text-xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Form input1', 'route' => '#', 'icon' => '<i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>',],
                            ['title' => 'Form input2', 'route' => '#', 'icon' => '<i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>',],
                            ['title' => 'Form input3', 'route' => '#', 'icon' => '<i class="ti ti-circle flex-shrink-0 text-xs me-3 "></i>',],

                        ]
                    ]
                ]
            ],


        ];
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.admin');
    }
}
