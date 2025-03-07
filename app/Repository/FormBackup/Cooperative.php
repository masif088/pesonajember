<?php

namespace App\Repository\FormBackup;

use App\Models\Status;
use App\Repository\FormBackup;

class Cooperative extends \App\Models\Cooperative implements Form
{


    public static function formRules(): array
    {
        return [
            'form.title' => 'required',
            'form.date_transaction' => 'required',
            'form.debit' => 'required',
            'form.credit' => 'nullable',
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
                'title' => 'Uraian',
                'type' => 'string',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Tanggal transaksi',
                'type' => 'date',
                'model' => 'date_transaction',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Debet',
                'type' => 'number',
                'model' => 'debit',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Kredit',
                'type' => 'number',
                'model' => 'credit',
                'required' => true,
                'class' => 'col-span-6',
            ],
        ];

        return $data;
    }
}
