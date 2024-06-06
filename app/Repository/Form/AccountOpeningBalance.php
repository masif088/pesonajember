<?php

namespace App\Repository\Form;

use App\Models\AccountName;
use App\Repository\Form;

class AccountOpeningBalance extends \App\Models\AccountOpeningBalance implements Form
{
    //company_asset_category_id', 'title','unit', 'month_acquisition', 'year_acquisition', 'useful_life', 'last_shrinkage'
    public static function formRules(): array
    {
        return [
            'form.account_name_id' => 'required',
            'form.month' => 'required',
            'form.year' => 'required',
            'form.opening_balances' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
        //', 'title','unit', 'month_acquisition', 'year_acquisition', 'useful_life', 'last_shrinkage'
        //        '', 'month', 'year', 'opening_balances'
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
        $accountName = [];
        foreach (AccountName::get() as $an) {
            $accountName[] = [
                'value' => $an->id, 'title' => "$an->code - $an->title",
            ];
        }

        return [
            [
                'title' => 'Nama Akun',
                'type' => 'select',
                'model' => 'account_name_id',
                'options' => $accountName,
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Bulan',
                'type' => 'select',
                'model' => 'month',
                'options' => $month,
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Tahun',
                'type' => 'number',
                'model' => 'year',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Jumlah uang',
                'type' => 'number',
                'model' => 'opening_balances',
                'required' => true,
                'class' => 'col-span-12',
            ],
        ];
    }
}
