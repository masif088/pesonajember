<?php

namespace App\Repository\FormBackup;

use App\Repository\FormBackup;

class SupplierCategory extends \App\Models\SupplierCategory implements Form
{
    protected $table = 'supplier_categories';

    public static function formRules(): array
    {
        return [
            'form.title' => 'required|max:255',
            'form.note' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

        $data = [
            [
                'title' => 'Judul kategori',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Catatan',
                'type' => 'textarea',
                'model' => 'note',
                'required' => false,
                'class' => 'col-span-12',
            ],
        ];

        return $data;
    }
}
