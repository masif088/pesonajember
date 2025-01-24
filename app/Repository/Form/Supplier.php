<?php

namespace App\Repository\Form;

use App\Repository\Form;

class Supplier extends \App\Models\Supplier implements Form
{
    protected $table = 'suppliers';

    public static function formRules(): array
    {

        return [
            'form.name' => 'required|max:255',
            'form.pic' => 'nullable|max:255',
            'form.email' => 'nullable|max:255',
            'form.phone' => 'nullable|max:255',
            'form.address' => 'nullable',
            'form.note' => 'nullable',
            'form.status' => 'nullable|numeric|between:0,1',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
        $status = [
            ['value' => 1, 'title' => 'Aktif'],
            ['value' => 0, 'title' => 'Tidak Aktif'],
        ];
        return [
            [
                'title' => 'Nama supplier',
                'type' => 'text',
                'model' => 'name',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'PIC',
                'type' => 'text',
                'model' => 'pic',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Email',
                'type' => 'text',
                'model' => 'email',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'No Hp',
                'type' => 'text',
                'model' => 'phone',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Status',
                'type' => 'select',
                'model' => 'status_id',
                'options' => $status,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Alamat',
                'type' => 'textarea',
                'model' => 'address',
                'class' => 'col-span-12',
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
