<?php

namespace App\Repository\Form;

use App\Repository\Form;
use Carbon\Carbon;

class ProofOfCash extends \App\Models\OrderProofOfCash implements Form
{

    protected $table = 'order_proof_of_cashes';

    public static function formRules(): array
    {
        return [
            'form.note' => 'nullable',
            'form.nominal' => 'nullable|numeric',
            'form.pic' => 'nullable|max:255',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function getNumber($id) :string
    {
        $partner = 
        $now  = Carbon::now();
        $month = numberToRomanRepresentation($now->month);
        $order = \App\Models\Order::whereYear('created_at', $now->year)->count()+1;
        $order_format = str_pad($order, 3, '0', STR_PAD_LEFT);
        return "$now->year/{$month}.{$now->day}/$order_format";
    }

    public static function formField($params = null): array
    {
        return [

            [
                'title' => 'Untuk pembayaran',
                'type' => 'textarea',
                'model' => 'note',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Nominal',
                'type' => 'number',
                'model' => 'nominal',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Pemesan',
                'type' => 'text',
                'model' => 'pic',
                'class' => 'col-span-12',
            ],

        ];
    }
}
