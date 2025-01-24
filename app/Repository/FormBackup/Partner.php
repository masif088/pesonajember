<?php

namespace App\Repository\FormBackup;

use App\Repository\FormBackup;

class Partner extends \App\Models\Partner implements Form
{
    protected $table = 'partners';

    public static function formRules(): array
    {

        return [
            'form.name' => 'required|max:255',
            'form.partner_category_id' => 'required',
            'form.email' => 'nullable',
            'form.phone' => 'nullable',
            'form.address' => 'nullable',
            'form.note' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

        $supplier = eloquent_to_options(\App\Models\PartnerCategory::get());
        //        '', 'name', 'phone', 'email', 'address', 'note'
        $data = [
            [
                'title' => 'Nama partner',
                'type' => 'text',
                'model' => 'name',
                'required' => true,
                'class' => 'col-span-4',
            ],
            [
                'title' => 'Email',
                'type' => 'text',
                'model' => 'email',
                'required' => false,
                'class' => 'col-span-4',
            ],
            [
                'title' => 'No Hp',
                'type' => 'text',
                'model' => 'phone',
                'required' => false,
                'class' => 'col-span-4',
            ],
            [
                'title' => 'Alamat',
                'type' => 'textarea',
                'model' => 'address',
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Catatan',
                'type' => 'textarea',
                'model' => 'note',
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Kategori',
                'type' => 'select',
                'model' => 'partner_category_id',
                'required' => true,
                'class' => 'col-span-12',
                'options' => $supplier,
            ],
        ];

        return $data;
    }
}
