<?php

namespace App\Repository\Form;

use App\Models\User;
use App\Repository\Form;

class Salary extends \App\Models\Salary implements Form
{

    protected $table = 'salaries';

    public static function formRules(): array
    {
        return [
            'form.user_id' => 'required',
            'form.salary' => 'numeric|min:0',
            'form.bonus' => 'numeric|min:0',
            'form.allowance' => 'numeric|min:0',
            'form.transportation' => 'numeric|min:0',
            'form.note' => 'nullable',
            'form.reference' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {


        $users = eloquent_to_options(User::get(),'id','name');
        return [
            [
                'title' => 'Nama Pegawai',
                'type' => 'select',
                'model' => 'user_id',
                'required' => true,
                'options'=>$users,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'No. Referensi',
                'type' => 'text',
                'model' => 'reference',
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Gaji Pokok',
                'type' => 'number',
                'model' => 'salary',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Bonus',
                'type' => 'number',
                'model' => 'bonus',
                'class' => 'col-span-6',
            ],       [
                'title' => 'Tunjangan',
                'type' => 'number',
                'model' => 'allowance',
                'class' => 'col-span-6',
            ],   [
                'title' => 'Transportasi',
                'type' => 'number',
                'model' => 'transportation',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Catatan',
                'type' => 'textarea',
                'model' => 'note',
                'class' => 'col-span-12',
            ],

        ];
    }
}
