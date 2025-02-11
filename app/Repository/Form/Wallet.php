<?php

namespace App\Repository\Form;

use App\Models\OrderMockup;
use App\Models\User;
use App\Repository\Form;

class Wallet extends \App\Models\Wallet implements Form
{

    public static function formRules(): array
    {
        return [
            'form.user_id'=>'required',
            'form.name'=>'required|string|max:256',
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
                'title' => 'Nama Dompet',
                'type' => 'text',
                'model' => 'name',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Penanggung Jawab/PIC',
                'type' => 'select',
                'model' => 'user_id',
                'class' => 'col-span-12',
                'options' => $users,
            ],
        ];
    }
}
