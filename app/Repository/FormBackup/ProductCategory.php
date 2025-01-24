<?php

namespace App\Repository\FormBackup;

use App\Repository\FormBackup;

class ProductCategory extends \App\Models\ProductCategory implements Form
{
    protected $table = 'product_categories';

    public static function formRules(): array
    {
        return [
            'form.title' => 'required|max:255',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

        //        'title', 'note'
        $data = [
            [
                'title' => 'Judul kategori',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-12',
            ],
        ];

        return $data;
    }
}
