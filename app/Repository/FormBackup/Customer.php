<?php

namespace App\Repository\FormBackup;

use App\Models\Status;
use App\Repository\FormBackup;

class Customer extends \App\Models\Customer implements Form
{
    protected $table = 'customers';

//$table->string('name');
//$table->string('phone')->nullable();
//$table->text('address')->nullable();
//$table->string('province')->nullable();
//$table->string('city')->nullable();
//$table->string('district')->nullable();
//$table->string('village')->nullable();
//$table->string('postal_code')->nullable();
//$table->string('npwp')->nullable();
//$table->date('register')->nullable();
//$table->unsignedBigInteger('status_id');
    public static function formRules(): array
    {
        return [
            'form.name' => 'required',
            'form.email' => 'nullable',
            'form.phone' => 'nullable',
            'form.address' => 'nullable',
            'form.province' => 'nullable',
            'form.city' => 'nullable',
            'form.district' => 'nullable',
            'form.village' => 'nullable',
            'form.postal_code' => 'nullable',
            'form.npwp' => 'nullable',
            'form.status_id' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

//        'form.name' => 'required',
//            'form.phone' => 'nullable',
//            'form.address' => 'nullable',
//            'form.province' => 'nullable',
//            'form.city' => 'nullable',
//            'form.district' => 'nullable',
//            'form.village' => 'nullable',
//            'form.postal_code' => 'nullable',
//            'form.npwp' => 'nullable',
//            'form.status_id' => 'nullable',
        $status = eloquent_to_options(Status::get());
        $data = [
            [
                'title' => 'Nama konsumen',
                'type' => 'text',
                'model' => 'name',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'No HP',
                'type' => 'text',
                'model' => 'phone',
                'required' => false,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Email',
                'type' => 'text',
                'model' => 'email',
                'required' => false,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Provinsi',
                'type' => 'text',
                'model' => 'province',
                'required' => false,
                'class' => 'col-span-3',
            ],
            [
                'title' => 'Kota/Kabupaten',
                'type' => 'text',
                'model' => 'city',
                'required' => false,
                'class' => 'col-span-3',
            ],
            [
                'title' => 'Kecamatan',
                'type' => 'text',
                'model' => 'district',
                'required' => false,
                'class' => 'col-span-3',
            ],
            [
                'title' => 'Kode Pos',
                'type' => 'text',
                'model' => 'postal_code',
                'required' => false,
                'class' => 'col-span-3',
            ], [
                'title' => 'Alamat lengkap',
                'type' => 'textarea',
                'model' => 'address',
                'required' => false,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Status',
                'type' => 'select',
                'model' => 'status_id',
                'options' => $status,
                'required' => false,
                'class' => 'col-span-6',
            ],

        ];

        return $data;
    }
}
