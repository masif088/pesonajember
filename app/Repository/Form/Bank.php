<?php

namespace App\Repository\Form;

use App\Models\Status;
use App\Repository\Form;

class Bank extends \App\Models\Bank implements Form
{
    protected $table = 'banks';

    public static function formRules(): array
    {
        return [
            'form.bank_name' => 'required',
            'form.account_in_name' => 'required',
            'form.note' => 'nullable',
            'form.status_id' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

        $status = eloquent_to_options(Status::get());
        $data = [
            [
                'title' => 'Nama Bank',
                'type' => 'text',
                'model' => 'bank_name',
                'required' => true,
                'class' => 'col-span-4',
            ],
            [
                'title' => 'Atas nama / nama akun',
                'type' => 'text',
                'model' => 'account_in_name',
                'required' => true,
                'class' => 'col-span-4',
            ],

            [
                'title' => 'Status',
                'type' => 'select',
                'model' => 'status_id',
                'options' => $status,
                'required' => false,
                'class' => 'col-span-4',
            ],
            [
                'title' => 'Catatan',
                'type' => 'textarea',
                'model' => 'address',
                'required' => false,
                'placeholder' => '',
                'class' => 'col-span-12',
            ],
        ];

        return $data;
    }
}
