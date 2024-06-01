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
                'app_list_two_side' => false,
                'quick_links' => [
                    ['title' => 'title 1', 'route' => '#'],
                    ['title' => 'title 2', 'route' => '#'],
                ],

                'app_lists_left' => [
                    ['title' => 'title 1', 'sub-title' => 'sub title2', 'icon_links' => '#', 'route' => '#'],
                ],
                'app_lists_right' => [
                    ['title' => 'title 1', 'sub-title' => 'sub title2', 'icon_links' => '#', 'route' => '#'],
                ],
            ],
            ['title' => 'Chat', 'type' => 'link', 'route' => '#'],
            ['title' => 'Calendar', 'type' => 'link', 'route' => '#'],
            ['title' => 'Email', 'type' => 'link', 'route' => '#'],

        ];

        $this->sidebar = [
            [
                'title' => 'Home',
                'lists' => [
                    ['title' => 'Dashboard', 'type' => 'link', 'route' => '#', 'icon' => '<i class="ti ti-brand-chrome  text-2xl flex-shrink-0"></i> '],
                    [
                        'title' => 'Penjualan', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-shopping-cart  text-2xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Pesanan Baru', 'route' => route('transaction.index','Penagihan'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Dp Diterima', 'route' => route('transaction.index','DP-diterima'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Produksi', 'route' => route('transaction.index','Proses-Produksi'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Pelunasan', 'route' => route('transaction.index','Pelunasan'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Pengiriman', 'route' => route('transaction.index','Pengiriman'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Selesai', 'route' => route('transaction.index','Selesai'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Perubahan Transaksi', 'route' => route('transaction.index','Perubahan-Transaksi'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],

                        ],
                    ],
                    [
                        'title' => 'Produksi', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-settings  text-2xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Produk', 'route' => route('production.index'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Mockup', 'route' => route('transaction.mockup-site'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Pola', 'route' => route('transaction.pattern-site'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Sampel', 'route' => route('transaction.sample-site'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Stock Bahan', 'route' => '#', 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Proses Produksi', 'route' => route('transaction.production.tab','Potong'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],

                        ],
                    ],
                    [
                        'title' => 'Stock/Aset', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-box  text-2xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Stock Material Bahan Baku', 'route' => route('material.index'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Kategori Material', 'route' => route('material.category'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Pengajuan Stock', 'route' => route('submission.index'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Aset Perusahaan', 'route' => route('company-asset.index'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                        ],
                    ],
                ],
            ],

            [
                'title' => 'Finance',
                'lists' => [
                    ['title' => 'Journal', 'type' => 'link', 'route' => route('finance.journal'), 'icon' => '<i class="ti ti-truck-delivery  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Pembukuan Keuangan', 'type' => 'link', 'route' => route('bank.index'), 'icon' => '<i class="ti ti-building-bank  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Kwitansi', 'type' => 'link', 'route' =>route('mutation-status.index'), 'icon' => '<i class="ti ti-arrows-right-left  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Kelola Akun Keuangan', 'type' => 'link', 'route' =>route('finance.account-names'), 'icon' => '<i class="ti ti-cash-banknote  text-xl flex-shrink-0"></i> '],
                ],
            ],

            [
                'title' => 'General info',
                'lists' => [
                    ['title' => 'Informasi Umum', 'type' => 'link', 'route' => route('general-info.index'), 'icon' => '<i class="ti ti-settings  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Ekspedisi barang', 'type' => 'link', 'route' => route('shipper.index'), 'icon' => '<i class="ti ti-truck-delivery  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Bank', 'type' => 'link', 'route' => route('bank.index'), 'icon' => '<i class="ti ti-building-bank  text-xl flex-shrink-0"></i> '],

                    [
                        'title' => 'Partner', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-users  text-xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Partner', 'type' => 'link', 'route' => route('partner.index'), 'icon' => '<i class="ti ti-circle  text-xs flex-shrink-0"></i>'],
                            ['title' => 'Partner Kategori', 'type' => 'link', 'route' => route('partner.category'), 'icon' => '<i class="ti ti-circle  text-xs flex-shrink-0"></i>'],
                        ],
                    ],
                    [
                        'title' => 'Suplier', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-users  text-xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Supplier', 'type' => 'link', 'route' => route('supplier.index'), 'icon' => '<i class="ti ti-circle  text-xs flex-shrink-0"></i>'],
                            ['title' => 'Supplier Kategori', 'type' => 'link', 'route' => route('supplier.category'), 'icon' => '<i class="ti ti-circle  text-xs flex-shrink-0"></i>'],
                        ],
                    ],
                    ['title' => 'Mutasi Status', 'type' => 'link', 'route' =>route('mutation-status.index'), 'icon' => '<i class="ti ti-arrows-right-left  text-xl flex-shrink-0"></i> '],
                ],
            ],

            [
                'title' => 'Karyawan Info',
                'lists' => [
                    ['title' => 'List Karyawan', 'type' => 'link', 'route' => route('employee.index'), 'icon' => '<i class="ti ti-settings  text-xl flex-shrink-0"></i> '],
//                    ['title' => 'Ekspedisi barang', 'type' => 'link', 'route' => route('shipper.index'), 'icon' => '<i class="ti ti-truck-delivery  text-xl flex-shrink-0"></i> '],
//                    ['title' => 'Bank', 'type' => 'link', 'route' => route('bank.index'), 'icon' => '<i class="ti ti-building-bank  text-xl flex-shrink-0"></i> '],
//
//                    [
//                        'title' => 'Partner', 'type' => 'accordion',
//                        'icon' => '<i class="ti ti-users  text-xl flex-shrink-0"></i>',
//                        'lists' => [
//                            ['title' => 'Partner', 'type' => 'link', 'route' => route('partner.index'), 'icon' => '<i class="ti ti-circle  text-xs flex-shrink-0"></i>'],
//                            ['title' => 'Partner Kategori', 'type' => 'link', 'route' => route('partner.category'), 'icon' => '<i class="ti ti-circle  text-xs flex-shrink-0"></i>'],
//                        ],
//                    ],
//                    [
//                        'title' => 'Suplier', 'type' => 'accordion',
//                        'icon' => '<i class="ti ti-users  text-xl flex-shrink-0"></i>',
//                        'lists' => [
//                            ['title' => 'Supplier', 'type' => 'link', 'route' => route('supplier.index'), 'icon' => '<i class="ti ti-circle  text-xs flex-shrink-0"></i>'],
//                            ['title' => 'Supplier Kategori', 'type' => 'link', 'route' => route('supplier.category'), 'icon' => '<i class="ti ti-circle  text-xs flex-shrink-0"></i>'],
//                        ],
//                    ],
//                    ['title' => 'Mutasi Status', 'type' => 'link', 'route' =>route('mutation-status.index'), 'icon' => '<i class="ti ti-arrows-right-left  text-xl flex-shrink-0"></i> '],
                ],
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
