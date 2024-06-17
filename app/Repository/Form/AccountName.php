<?php

namespace App\Repository\Form;

use App\Models\AccountCategory;
use App\Models\Status;
use App\Repository\Form;

class AccountName extends \App\Models\AccountName implements Form
{
    public static function formRules(): array
    {
        return [
            'form.account_category_id' => 'required',
            'form.level' => 'required',
            'form.code' => 'required',
            'form.title' => 'nullable',
            'form.note' => 'required',
            'form.additional_cost' => 'required',
            'form.status_id' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
//        \App\Models\AccountName::create([
//            'account_category_id' => 11,
//            'level' => 'CR',
//            'code' => '4.03.001',
//            'title' => 'Hutang ...',
//            'additional_cost' => 0,
//            'status_id' => 1,
//        ]);

        $accountCategory = [];
        foreach (AccountCategory::get() as $c){
            $accountCategory[]=['value'=>$c->id,'title'=>"$c->code - $c->title"];
        }
        $accountLevel = [
            ['value'=>'CR','title'=>'CR'],
            ['value'=>'DR','title'=>'DR'],
        ];
        $additionalCost = [
            ['value'=>'1','title'=>'Iya'],
            ['value'=>'0','title'=>'Tidak'],
        ];
        $status = [
            ['value'=>'1','title'=>'Aktif'],
            ['value'=>'0','title'=>'Tidak aktif'],
        ];
        $data = [
            [
                'title' => 'Nama Akun',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Account Kategori',
                'type' => 'select',
                'model' => 'account_category_id',
                'options' => $accountCategory,
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Code',
                'type' => 'text',
                'model' => 'code',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Level',
                'type' => 'select',
                'model' => 'level',
                'options' => $accountLevel,
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Level',
                'type' => 'select',
                'model' => 'status_id',
                'options' => $status,
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Eksternal cost',
                'type' => 'select',
                'model' => 'additional_cost',
                'options' => $additionalCost,
                'required' => true,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Catatan',
                'type' => 'textarea',
                'model' => 'note',
                'required' => false,
                'placeholder' => '',
                'class' => 'col-span-12',
            ],
        ];

        return $data;
    }
}
