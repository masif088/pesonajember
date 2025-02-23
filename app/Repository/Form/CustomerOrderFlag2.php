<?php

namespace App\Repository\Form;

use App\Repository\Form;

class CustomerOrderFlag2 implements Form
{

    protected $table = 'customers';

    public static function formRules(): array
    {
        return [
            'form.name' => 'required|max:255',
            'form.company_name' => 'nullable|max:255',
            'form.phone' => 'nullable|max:255',
            'form.email' => 'nullable',
            'form.note' => 'nullable',
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
                'title' => 'Nama konsumen',
                'type' => 'text',
                'model' => 'customer2.company_name',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Nama PIC konsumen',
                'type' => 'text',
                'model' => 'customer2.name',
                'required' => true,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Nomer HP konsumen',
                'type' => 'text',
                'model' => 'customer2.phone',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Email konsumen',
                'type' => 'text',
                'model' => 'customer2.email',
                'class' => 'col-span-6',
            ],

        ];
    }
}
