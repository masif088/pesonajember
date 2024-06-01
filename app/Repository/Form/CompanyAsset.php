<?php

namespace App\Repository\Form;

use App\Models\CompanyAssetCategory;
use App\Repository\Form;

class CompanyAsset extends \App\Models\CompanyAsset implements Form
{
    protected $table = 'company_assets';

    //company_asset_category_id', 'title','unit', 'month_acquisition', 'year_acquisition', 'useful_life', 'last_shrinkage'
    public static function formRules(): array
    {
        return [
            'form.company_asset_category_id' => 'required',
            'form.title' => 'required',
            'form.unit' => 'required',
            'form.value' => 'required',
            'form.month_acquisition' => 'required',
            'form.year_acquisition' => 'required',
            'form.useful_life' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
        //', 'title','unit', 'month_acquisition', 'year_acquisition', 'useful_life', 'last_shrinkage'

        $month = [
            ['value' => '1', 'title' => 'Januari'],
            ['value' => '2', 'title' => 'Februari'],
            ['value' => '3', 'title' => 'Maret'],
            ['value' => '4', 'title' => 'April'],
            ['value' => '5', 'title' => 'Mei'],
            ['value' => '6', 'title' => 'Juni'],
            ['value' => '7', 'title' => 'Juli'],
            ['value' => '8', 'title' => 'Agustus'],
            ['value' => '9', 'title' => 'September'],
            ['value' => '10', 'title' => 'Oktober'],
            ['value' => '11', 'title' => 'November'],
            ['value' => '12', 'title' => 'Desember'],
        ];

        $companyAsset = eloquent_to_options(CompanyAssetCategory::get());

        return [
            [
                'title' => 'Kategori Asset',
                'type' => 'select',
                'model' => 'company_asset_category_id',
                'options' => $companyAsset,
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Nama Asset',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Unit',
                'type' => 'number',
                'model' => 'unit',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Masa Manfaat',
                'type' => 'number',
                'model' => 'useful_life',
                'required' => true,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Bulan Beli',
                'type' => 'select',
                'model' => 'month_acquisition',
                'options' => $month,
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Tahun Beli',
                'type' => 'number',
                'model' => 'year_acquisition',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Harga Perolehan',
                'type' => 'number',
                'model' => 'value',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Angka Penyusutan',
                'type' => 'number',
                'model' => 'last_shrinkage',
                'required' => true,
                'class' => 'col-span-6',
            ],

        ];
    }
}
