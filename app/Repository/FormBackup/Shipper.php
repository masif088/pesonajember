<?php

namespace App\Repository\FormBackup;

use App\Repository\FormBackup;

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
        $shipper = [
            ['value' => 'anteraja', 'title' => 'anteraja'],
            ['value' => 'borzo', 'title' => 'borzo'],
            ['value' => 'deliveree', 'title' => 'deliveree'],
            ['value' => 'gojek', 'title' => 'gojek'],
            ['value' => 'grab', 'title' => 'grab'],
            ['value' => 'idexpress', 'title' => 'idexpress'],
            ['value' => 'jdl', 'title' => 'jdl'],
            ['value' => 'jne', 'title' => 'jne'],
            ['value' => 'jnt', 'title' => 'jnt'],
            ['value' => 'lalamove', 'title' => 'lalamove'],
            ['value' => 'lion', 'title' => 'lion'],
            ['value' => 'mrspeedy', 'title' => 'mrspeedy'],
            ['value' => 'ninja', 'title' => 'ninja'],
            ['value' => 'paxel', 'title' => 'paxel'],
            ['value' => 'pos', 'title' => 'pos'],
            ['value' => 'rara', 'title' => 'rara'],
            ['value' => 'rpx', 'title' => 'rpx'],
            ['value' => 'sap', 'title' => 'sap'],
            ['value' => 'sicepat', 'title' => 'sicepat'],
            ['value' => 'tiki', 'title' => 'tiki'],
            ['value' => 'wahana', 'title' => 'wahana'],
        ];
        $data = [
            [
                'title' => 'Nama ekspedisi',
                'type' => 'select',
                'model' => 'title',
                'options' => $shipper,
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
