<?php

namespace App\Repository\Form;

use App\Repository\Form;

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

        $supplier = eloquent_to_options(\App\Models\SupplierCategory::get());
        //        'supplier_category_id', 'title', 'name', 'email', 'phone'
        $data = [
            [
                'title' => 'Nama supplier',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'PIC',
                'type' => 'text',
                'model' => 'name',
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Link',
                'type' => 'text',
                'model' => 'email',
                'required' => false,
                'class' => 'col-span-6',
            ], [
                'title' => 'No Hp',
                'type' => 'text',
                'model' => 'phone',
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Kategori',
                'type' => 'select',
                'model' => 'supplier_category_id',
                'required' => true,
                'class' => 'col-span-12',
                'options' => $supplier,
            ],
        ];

        return $data;
    }
}
