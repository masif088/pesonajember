<?php

namespace App\Repository\FormBackup;

use App\Repository\FormBackup;

class Supplier extends \App\Models\Supplier implements Form
{
    protected $table = 'suppliers';

    public static function formRules(): array
    {

        return [
            'form.title' => 'required|max:255',
            'form.supplier_category_id' => 'required',
            'form.name' => 'nullable|max:255',
            'form.email' => 'nullable',
            'form.phone' => 'nullable',
            'form.note' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

//        $supplier = eloquent_to_options(\App\Models\SupplierCategory::get());
        $data = [
            [
                'title' => 'Nama supplier',
                'type' => 'text',
                'model' => 'name',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'PIC',
                'type' => 'text',
                'model' => 'pic',
                'required' => false,
                'class' => 'col-span-6',
            ],
             [
                'title' => 'No Hp',
                'type' => 'text',
                'model' => 'phone',
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'No Hp',
                'type' => 'text',
                'model' => 'phone',
                'required' => false,
                'class' => 'col-span-6',
            ],

        ];

        return $data;
    }
}
