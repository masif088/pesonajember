<?php

namespace App\Repository\Form;

use App\Models\Status;
use App\Repository\Form;

class Shipper extends \App\Models\Shipper implements Form
{
    protected $table = 'shippers';

    public static function formRules(): array
    {
        return [
            'form.title' => 'required',
            'form.location' => 'required',
            'form.phone' => 'required',
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
                'title' => 'Nama ekspedisi',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Nomer HP',
                'type' => 'text',
                'model' => 'location',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Lokasi',
                'type' => 'textarea',
                'model' => 'phone',
                'required' => true,
                'class' => 'col-span-12',
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
