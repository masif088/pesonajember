<?php

namespace App\Repository\Form;

use App\Repository\Form;

class Partner extends \App\Models\Partner implements Form
{

    protected $table = 'partners';

    public static function formRules(): array
    {

//        ['name', 'status', 'kop', 'logo', 'address', 'phone', 'format_number_invoice', '', '', '', '', 'sign_name', 'sign_position', 'note']
        return [
            'form.name' => 'required|max:255',
            'form.sign_name' => 'nullable|max:255',
            'form.sign_position' => 'nullable|max:255',
            'form.format_number_invoice' => 'nullable|max:255',
            'form.format_number_driver' => 'nullable|max:255',
            'form.format_number_proof_of_cash' => 'nullable|max:255',
            'form.format_number_outcome' => 'nullable|max:255',
            'form.format_number_income' => 'nullable|max:255',
            'form.phone' => 'nullable|max:255',
            'form.address' => 'nullable',
            'form.note' => 'nullable',
            'form.status' => 'nullable|numeric',
            'form.kop_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'form.logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
//            'form.kop_image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'form.logo_image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        return [
            [
                'title' => 'Nama partner/cv',
                'type' => 'text',
                'model' => 'name',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'No Hp',
                'type' => 'text',
                'model' => 'phone',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Yang bertanda tangan di dokumen',
                'type' => 'text',
                'model' => 'sign_name',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Posisi yang bertanda tangan di dokumen',
                'type' => 'text',
                'model' => 'sign_position',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Format nomer invoice',
                'type' => 'text',
                'model' => 'format_number_invoice',
                'class' => 'col-span-6',
            ], [
                'title' => 'Format nomer surat jalan',
                'type' => 'text',
                'model' => 'format_number_driver',
                'class' => 'col-span-6',
            ], [
                'title' => 'Format nomer kwitansi',
                'type' => 'text',
                'model' => 'format_number_proof_of_cash',
                'class' => 'col-span-6',
            ], [
                'title' => 'Format nomer barang keluar',
                'type' => 'text',
                'model' => 'format_number_outcome',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Format nomer barang masuk',
                'type' => 'text',
                'model' => 'format_number_income',
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Status',
                'type' => 'select',
                'model' => 'status',
                'options' => $status,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Kop surat',
                'type' => 'file',
                'model' => 'kop_image',
                'class' => 'col-span-6',
                'accept' => 'image/*',
            ],
            [
                'title' => 'Logo',
                'type' => 'file',
                'model' => 'logo_image',
                'class' => 'col-span-6',
                'accept' => 'image/*',
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
