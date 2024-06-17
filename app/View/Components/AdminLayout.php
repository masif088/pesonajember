<?php

namespace App\View\Components;

use App\Repository\View\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public $sidebar;

    public $navbar;

    public function setValue($count)
    {
        return "<span class='rounded-2xl border bg-error text-white border-none flex-shrink-0' style='margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center' >$count</span>";
    }

    public function __construct()
    {

        $this->navbar = [
            //            [
            //                'title' => 'Apps',
            //                'type' => 'dropdown',
            //                'app_list_two_side' => false,
            //                'quick_links' => [
            //                    ['title' => 'title 1', 'route' => '#'],
            //                    ['title' => 'title 2', 'route' => '#'],
            //                ],
            //
            //                'app_lists_left' => [
            //                    ['title' => 'title 1', 'sub-title' => 'sub title2', 'icon_links' => '#', 'route' => '#'],
            //                ],
            //                'app_lists_right' => [
            //                    ['title' => 'title 1', 'sub-title' => 'sub title2', 'icon_links' => '#', 'route' => '#'],
            //                ],
            //            ],
            //            ['title' => 'Chat', 'type' => 'link', 'route' => '#'],
            //            ['title' => 'Calendar', 'type' => 'link', 'route' => '#'],
            //            ['title' => 'Email', 'type' => 'link', 'route' => '#'],

        ];

        $query = 'SELECT transaction_statuses.transaction_status_type_id as transaction_status_type_id , count(*) as count FROM `transactions` JOIN transaction_statuses ON transaction_statuses.id = transactions.transaction_status_id where transactions.deleted_at=null group by transaction_statuses.transaction_status_type_id';
        $order = DB::select($query);
        $count = [];
        $count['production'] = 0;
        $count['product'] = 0;
        $count['repayment'] = 0;
        foreach ($order as $o) {
            $count[$o->transaction_status_type_id] = $o->count;
            if ($o->transaction_status_type_id >= 3 && $o->transaction_status_type_id <= 11) {
                $count['production'] += $o->count;
            }
            if ($o->transaction_status_type_id >= 6 && $o->transaction_status_type_id <= 11) {
                $count['product'] += $o->count;
            }
            if ($o->transaction_status_type_id == 12 || $o->transaction_status_type_id == 13) {
                $count['repayment'] += $o->count;
            }
        }
        //        dd($count);
        //        dd($count);
        //        dd($order[0]);
        //        $newOrder = Transaction::whereHas('transactionStatus',function (Builder $q){
        //            $q->where('transaction_status_type_id','=',1);
        //        })->count();

        $this->sidebar = [
            [
                'title' => 'Home',
                'lists' => [
                    ['title' => 'Dashboard', 'type' => 'link', 'route' => route('dashboard'), 'icon' => '<i class="ti ti-brand-chrome  text-2xl flex-shrink-0"></i> '],

                    [
                        'title' => 'Produk', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-box  text-2xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Produk', 'route' => route('production.index'), 'icon' => ""],
                            ['title' => 'Kategori Produk', 'route' => route('production.category'), 'icon' => ''],
                        ],
                    ],
                    [
                        'title' => 'Penjualan', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-shopping-cart  text-2xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Pesanan Baru', 'route' => route('transaction.index', 'Penagihan'), 'icon' => isset($count[1]) ? $this->setValue($count[1]) : ''],
                            ['title' => 'Dp Diterima', 'route' => route('transaction.index', 'DP-diterima'), 'icon' => isset($count[2]) ? $this->setValue($count[2]) : ''],
                            ['title' => 'Produksi', 'route' => route('transaction.index', 'Proses-Produksi'), 'icon' => ($count['production'] != 0) ? $this->setValue($count['production']) : ''],
                            ['title' => 'Pelunasan', 'route' => route('transaction.index', 'Pelunasan'), 'icon' => ($count['repayment'] != 0) ? $this->setValue($count['repayment']) : ''],
                            ['title' => 'Pengiriman', 'route' => route('transaction.index', 'Pengiriman'), 'icon' => isset($count[14]) ? $this->setValue($count[14]) : ''],
                            ['title' => 'Selesai', 'route' => route('transaction.index', 'Selesai'), 'icon' => isset($count[15]) ? $this->setValue($count[15]) : ''],
                            ['title' => 'Perubahan Transaksi', 'route' => route('transaction.index', 'Perubahan-Transaksi'), 'icon' => ''],
                        ],
                    ],
                    [
                        'title' => 'Produksi', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-settings  text-2xl flex-shrink-0"></i>',
                        'lists' => [

                            ['title' => 'Mockup', 'route' => route('transaction.mockup-site'), 'icon' => isset($count[3]) ? $this->setValue($count[3]) : ''],
                            ['title' => 'Pola', 'route' => route('transaction.pattern-site'), 'icon' => isset($count[4]) ? $this->setValue($count[4]) : ''],
                            ['title' => 'Sampel', 'route' => route('transaction.sample-site'), 'icon' => isset($count[5]) ? $this->setValue($count[5]) : ''],
                            ['title' => 'Proses Produksi', 'route' => route('transaction.production.tab', 'Potong'), 'icon' => ($count['product']!=0) ? $this->setValue($count['product']) : ''],
                            //                            ['title' => 'Stock Bahan', 'route' => '#', 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],

                        ],
                    ],
                    [
                        'title' => 'Stock/Aset', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-box  text-2xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Stock Material Bahan Baku', 'route' => route('material.index'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Kategori Material', 'route' => route('material.category'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            //                            ['title' => 'Pengajuan Stock', 'route' => route('submission.index'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                            ['title' => 'Aset Perusahaan', 'route' => route('company-asset.index'), 'icon' => '<span class="rounded-2xl border bg-error text-white border-none flex-shrink-0" style="margin:0;padding: 0;font-size: 10px; width: 20px; height: 20px; text-align: center" >2</span>'],
                        ],
                    ],
                ],
            ],

            [
                'title' => 'Finance',
                'lists' => [
                    ['title' => 'Kas Kecil', 'type' => 'link', 'route' => route('finance.petty-cash'), 'icon' => '<i class="ti ti-wallet  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Kas Besar', 'type' => 'link', 'route' => route('finance.big-cash'), 'icon' => '<i class="ti ti-wallet  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Saldo Awal Neraca', 'type' => 'link', 'route' => route('finance.account-opening-balance'), 'icon' => '<i class="ti ti-cash  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Pembukuan Keuangan', 'type' => 'link', 'route' => route('finance.journal'), 'icon' => '<i class="ti ti-cash  text-xl flex-shrink-0"></i> '],
                    ['title' => 'Gaji Karyawan', 'type' => 'link', 'route' => route('salary.index'), 'icon' => '<i class="ti ti-user-dollar  text-xl flex-shrink-0"></i> '],
                    //                    ['title' => 'Buku Penjualan', 'type' => 'link', 'route' => route('salary.index'), 'icon' => ''],
                    [
                        'title' => 'Buku Penjualan', 'type' => 'accordion',
                        'icon' => '<i class="ti ti-book  text-xl flex-shrink-0"></i>',
                        'lists' => [
                            ['title' => 'Penjualan Berjalan', 'type' => 'link', 'route' => route('finance.transaction'), 'icon' => '<i class="ti ti-replace  text-xs flex-shrink-0"></i>'],
                            ['title' => 'Riwayat Penjualan', 'type' => 'link', 'route' => route('finance.transaction-history'), 'icon' => '<i class="ti ti-clock  text-xs flex-shrink-0"></i>'],
                        ],
                    ],

                    ['title' => 'List Nama Akun', 'type' => 'link', 'route' => route('finance.account-names'), 'icon' => '<i class="ti ti-book-2  text-xl flex-shrink-0"></i> '],
                ],
            ],

            [
                'title' => 'General info',
                'lists' => [
                    ['title' => 'Rekap Konsumen', 'type' => 'link', 'route' => route('customer.index'), 'icon' => '<i class="ti ti-users  text-xl flex-shrink-0"></i> '],
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
                    ['title' => 'Mutasi Status', 'type' => 'link', 'route' => route('mutation-status.index'), 'icon' => '<i class="ti ti-arrows-right-left  text-xl flex-shrink-0"></i> '],
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
