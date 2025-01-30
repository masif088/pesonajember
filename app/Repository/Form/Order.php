<?php

namespace App\Repository\Form;

use App\Models\TransactionType;
use App\Models\User;
use App\Repository\Form;
use Carbon\Carbon;

class Order implements Form
{
    public static function formRules(): array
    {
        return [];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function getOderNumber() :string
    {
        $now  = Carbon::now();
        $month = numberToRomanRepresentation($now->month);
        $order = \App\Models\Order::whereYear('created_at', $now->year)->count()+1;
        $order_format = str_pad($order, 3, '0', STR_PAD_LEFT);
        return "$now->year/{$month}.{$now->day}/$order_format";
    }

    public static function formField($params = null): array
    {
        $partner = eloquent_to_options(\App\Models\Partner::get(),'id','name');
        $users = eloquent_to_options(User::get(),'id','name');
        return [
            [
                'title' => 'CV/UD Transaksi',
                'type' => 'select2',
                'model' => 'partners',
                'options' => $partner,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'PIC',
                'type' => 'select',
                'model' => 'user_id',
                'options' => $users,
                'class' => 'col-span-12',
            ],
        ];
    }
}
