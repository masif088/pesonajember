<?php

namespace App\Repository\Form;

use App\Models\User;
use App\Repository\Form;
use Carbon\Carbon;

class OrderTax extends \App\Models\Order implements Form
{
    public static function formRules(): array
    {
        return [];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function getOrderNumber() :string
    {
        $now  = Carbon::now();
        $month = numberToRomanRepresentation($now->month);
        $order = \App\Models\Order::whereYear('created_at', $now->year)->count()+1;
        $order_format = str_pad($order, 3, '0', STR_PAD_LEFT);
        return "$now->year/{$month}.{$now->day}/$order_format";
    }

    public static function formField($params = null): array
    {
        $partner= [];
        foreach (\App\Models\Partner::where('status',1)->get() as $param) {
            $partner[]=['value'=>$param->id,'title'=>$param->company_name." ".$param->name];
        }
        $users = eloquent_to_options(User::get(),'id','name');
        return [
//            [
//                'title' => 'CV/UD Transaksi',
//                'type' => 'select2',
//                'model' => 'partners',
//                'options' => $partner,
//                'class' => 'col-span-12',
//            ],

            [
                'title' => 'PPN',
                'type' => 'number',
                'model' => 'ppn',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'PPh (bawaan untuk seluruh produk)',
                'type' => 'number',
                'model' => 'pph',
                'class' => 'col-span-6',
            ],
        ];
    }
}
