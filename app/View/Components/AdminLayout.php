<?php

namespace App\View\Components;

use App\Models\Partner;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public $sidebar;

    public $navbar;

    public function __construct()
    {
        $productOut =[];
        $invoice =[];
        $proofOfCash =[];
        $margin =[];

        foreach (Partner::where('status',1)->get() as $partner){
            $productOut[]= [
                'title' => $partner->name,
                'route' => route('admin.product-out.index',$partner->id),
                'icon' => '<span style="width: 10px"></span>  '
            ];
            $invoice[]= [
                'title' => $partner->name,
                'route' => route('admin.invoice.index',$partner->id),
                'icon' => '<span style="width: 10px"></span>  '
            ];
            $proofOfCash[]= [
                'title' => $partner->name,
                'route' => route('admin.proof-of-cash.index',$partner->id),
                'icon' => '<span style="width: 10px"></span>  '
            ];
            $margin[]= [
                'title' => $partner->name,
                'route' => route('admin.product-out.index',$partner->id),
                'icon' => '<span style="width: 10px"></span>  '
            ];
        }

        $this->sidebar = [
            [
                'title' => 'Home',
                'lists' => [
                    ['title' => 'Dashboard', 'type' => 'link', 'route' => route('admin.dashboard'), 'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="material-symbols:dashboard-rounded"></span>'],
                    [
                        'title' => 'Input Order Baru',
                        'type' => 'link',
                        'route' => route('admin.order.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="solar:wallet-money-bold"></span>'

                    ],
                    [
                        'title' => 'Barang keluar <br> & Surat Jalan', 'type' => 'accordion',
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="solar:inbox-out-bold"></span>',
                        'lists' => $productOut,
                    ],
                    [
                        'title' => 'Laba Rugi', 'type' => 'accordion',
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="mdi:margin"></span>',
                        'lists' => [
                            ['title' => 'E-Katalog', 'route' => route('admin.margin.index',2), 'icon' => '<span style="width: 10px"></span>  '],
                            ['title' => 'By Order', 'route' => route('admin.margin.index',1), 'icon' => '<span style="width: 10px"></span>  '],
                            ['title' => 'Pinjam Bendera', 'route' => route('admin.margin.index',3), 'icon' => '<span style="width: 10px"></span>  '],
                        ],
                    ],

                    ['title' => 'Rekap Transaksi', 'type' => 'link', 'route' => route('admin.order.order-recapitulation'), 'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="icon-park-solid:transaction-order"></span>'],
//                    ['title' => 'Perubahan Transaksi', 'type' => 'link', 'route' => '#', 'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="basil:edit-solid"></span>'],
                    ['title' => 'Order Selesai', 'type' => 'link', 'route' => route('admin.order.order-done'), 'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="ion:checkmark-done-circle"></span>'],
                    ['title' => 'Order Cancel', 'type' => 'link', 'route' => route('admin.order.order.cancel'), 'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="ic:round-cancel"></span>'],
                ],
            ],
            [
                'title' => 'Finance',
                'lists' => [
                    [
                        'title' => 'Dompet Kas',
                        'type' => 'link',
                        'route' => route('admin.wallet.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="mdi:wallet"></span>'
                    ],

                    [
                        'title' => 'Gaji Karyawan',
                        'type' => 'link',
                        'route' => route('admin.salary.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="mdi:wallet"></span>'
                    ],


                    [
                        'title' => 'Invoice',
                        'type' => 'accordion',
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="fa6-solid:file-invoice-dollar"></span>',
                        'lists'=>$invoice
                    ],

                    [
                        'title' => 'Kwitansi',
                        'type' => 'accordion',
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="fa6-solid:file-invoice-dollar"></span>',
                        'lists'=>$proofOfCash
                    ],

//                    [
//                        'title' => 'Laba rugi',
//                        'type' => 'accordion',
//                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="vaadin:book-dollar"></span>',
//                        'lists'=>$margin
//                    ],

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
                        'title' => 'Data Karyawan',
                        'type' => 'link',
                        'route' => route('admin.employee.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="fluent:text-bullet-list-square-person-32-filled"></span>'
                    ],

//                    [
//                        'title' => 'Ekspedisi Barang',
//                        'type' => 'link',
//                        'route' => route('admin.supplier.index'),
//                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="material-symbols:local-shipping-rounded"></span>'
//                    ],
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
            [
                'title' => 'Human Resource',
                'lists' => [
                    [
                        'title' => 'List Karyawan',
                        'type' => 'link',
                        'route' => route('admin.employee.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="f7:doc-person-fill"></span>'
                    ],

                    [
                        'title' => 'Gaji Karyawan',
                        'type' => 'link',
                        'route' => route('admin.supplier.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="fluent:payment-32-filled"></span>'
                    ],
                    [
                        'title' => 'Role & Izin Akun',
                        'type' => 'link',
                        'route' => route('admin.partner.index'),
                        'icon' => '<span class="iconify text-gray-600 text-2xl" data-icon="eos-icons:role-binding"></span>'
                    ],
                ],

            ],
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
