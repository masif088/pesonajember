<?php

namespace App\Repository\FormBackup;


use App\Models\UserStatus;
use App\Repository\FormBackup;


class User extends \App\Models\User implements Form
{
    protected $table = 'users';

    public static function formRules(): array
    {
        return [
            "form.name" => 'required',
            "form.nip" => 'required',
            'form.email' => 'required|email',
//            'form.no_phone' => 'required',
            'form.role' => 'required',
            'form.password' => 'required',
            'form.position' => 'required',
//            'form.address' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }


    public static function formField($params = null): array
    {
//        if (auth()->user()->role==1){
        $role = [
            ['value' => 1, 'title' => 'Admin'],
            ['value' => 2, 'title' => 'Pegawai'],
//                ['value' => 3, 'title' => 'Pengguna'],
        ];
//        }else{
//            $role=[
//                ['value' => 3, 'title' => 'Pengguna'],
//            ];
//        }
//        $active=eloquent_to_options(UserStatus::get());
        $data = [
            [
                'title' => 'Nama Lengkap',
                'type' => 'text',
                'model' => 'name',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Nomor Induk Pegawai',
                'type' => 'text',
                'model' => 'nip',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Email',
                'type' => 'email',
                'model' => 'email',
                'required' => true,
                'class' => 'col-span-12',
            ],

            [
                'title' => 'Password',
                'type' => 'text',
                'model' => 'password',
                'required' => false,
                'placeholder' => '',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Sebagai',
                'type' => 'select',
                'model' => 'role',
                'options' => $role,
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Posisi',
                'type' => 'text',
                'model' => 'position',
                'required' => true,
                'class' => 'col-span-6',
            ],
//            [
//                'title' => 'Alamat',
//                'type' => 'textarea',
//                'model' => 'address',
//                'required' => false,
//                'placeholder' => '',
//            ],
        ];

//        if ($params=="create"){
//            $data[]=
//                [
//                    'title' => 'Sebagai',
//                    'type' => 'select',
//                    'model' => 'role',
//                    'options' => $role,
//                    'required' => false,
//                ];
//        }


        return $data;
    }
}
