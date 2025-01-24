<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public $sidebar;

    public $navbar;

    public function __construct()
    {



        $this->sidebar = [
            [
                'title' => 'Home',
                'lists' => [
                    ['title' => 'Dashboard', 'type' => 'link', 'route' => route('admin.dashboard'), 'icon' => '<i class="ti ti-brand-chrome  text-2xl flex-shrink-0"></i> '],
                    [
                        'title' => 'Input Order Baru',
                        'type' => 'link',
                        'route' => route('admin.order.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="solar:wallet-money-bold"></span>'
                    ],
                ],
            ],

            [

                'title' => 'General Info',
                'lists' => [
                    [
                        'title' => 'Rekap Konsumen',
                        'type' => 'link',
                        'route' => route('admin.customer.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="fluent:text-bullet-list-square-person-32-filled"></span>'
                    ],

                    [
                        'title' => 'List Bank',
                        'type' => 'link',
                        'route' => route('admin.supplier.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="mdi:folder-information"></span>'
                    ],

                    [
                        'title' => 'Ekspedisi Barang',
                        'type' => 'link',
                        'route' => route('admin.supplier.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="material-symbols:local-shipping-rounded"></span>'
                    ],

                    [
                        'title' => 'Partner / CV',
                        'type' => 'link',
                        'route' => route('admin.partner.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="mdi:partnership"></span>'
                    ],


                    [
                        'title' => 'Supplier',
                        'type' => 'link',
                        'route' => route('admin.supplier.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="iconamoon:box-fill"></span>'
                    ],
                ],
            ],
//            [
//                'title' => 'General info',
//                'lists' => [],
//            [
//                'title' => 'Pola & Sampel', 'type' => 'accordion',
//                'icon' => '<i class="ti ti-settings  text-2xl flex-shrink-0"></i>',
//                'lists' => [
////                        ['title' => 'Mockup', 'route' => route('transaction.mockup-site'), 'icon' => isset($count[3]) ? $this->setValue($count[3]) : ''],
//                    ['title' => 'Pola', 'route' => route('transaction.pattern-site'), 'icon' => isset($count[4]) ? $this->setValue($count[4]) : ''],
//                    ['title' => 'Sampel', 'route' => route('transaction.sample-site'), 'icon' => isset($count[5]) ? $this->setValue($count[5]) : ''],
//                    //                            ['title' => 'Stock Bahan', 'route' => '#', 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
//                ],
//            ];
//            ],
//            [
//                'title' => 'Karyawan Info',
//                'lists' => [],
//            ],
        ];



    }

    public function setValue($count)
    {
        return "<div class='rounded-xl border bg-error text-white border-none flex justify-center h-5 w-5 text-xs' ><span class='m-auto'>$count</span></div>";
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.admin');
    }
}
