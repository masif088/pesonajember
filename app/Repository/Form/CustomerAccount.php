<?php

namespace App\Repository\Form;

use App\Models\User;
use App\Repository\Form;

class CustomerAccount extends \App\Models\CustomerAccount implements Form
{

    public static function formRules(): array
    {

        return [
            'form.bank_name' => 'required',
            'form.account_name' => 'required',
            'form.account_number' => 'required',
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
                'title' => 'Nama Bank',
                'type' => 'text',
                'model' => 'bank_name',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Atas Nama Rekening',
                'type' => 'text',
                'model' => 'account_name',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Nomer Rekening',
                'type' => 'text',
                'model' => 'account_number',
                'class' => 'col-span-6',
            ],
        ];
    }
}
