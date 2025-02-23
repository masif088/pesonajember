<?php

namespace App\Repository\Form;

use App\Repository\Form;

class CustomerOrderFlag implements Form
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
                'title' => 'Nama perusahaan peminjam bendera',
                'type' => 'text',
                'model' => 'customer.company_name',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Nama PIC peminjam bendera',
                'type' => 'text',
                'model' => 'customer.name',
                'required' => true,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Nomer HP peminjam bendera',
                'type' => 'text',
                'model' => 'customer.phone',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Email peminjam bendera',
                'type' => 'text',
                'model' => 'customer.email',
                'class' => 'col-span-6',
            ],


        ];
    }
}
