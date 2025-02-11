<?php

namespace App\Repository\Form;

use App\Models\User;
use App\Repository\Form;

class WalletDetail extends \App\Models\WalletDetail implements Form
{

    public static function formRules(): array
    {
        return [
            'form.description'=>'required|string|max:256',
            'form.date'=>'required|string|date_format:Y-m-d',
            'form.debit'=>'required|numeric|min:0',
            'form.credit'=>'required|numeric|min:0',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
        return [
            [
                'title' => 'Keterangan',
                'type' => 'text',
                'model' => 'description',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Tanggal transaksi',
                'type' => 'date',
                'model' => 'date',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Debet',
                'type' => 'number',
                'model' => 'debit',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Kredit',
                'type' => 'number',
                'model' => 'credit',
                'class' => 'col-span-6',
            ],
        ];
    }
}
