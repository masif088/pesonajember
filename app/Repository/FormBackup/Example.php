<?php

namespace App\Repository\FormBackup;


use App\Repository\FormBackup;


class Example extends \App\Models\User implements Form {


    public static function formRules(): array
    {
        return [
            "data.name"     => 'required',
            'data.email'    => 'required',
            'data.password' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }


    public static function formField($params = null): array
    {
        return [
            [
                'title'       => 'Textarea',
                'type'        => 'editor',
                'model'       => 'name',
                'options'     => [
                    ['value' => 1, 'title' => 'asdasd'],
                    ['value' => 2, 'title' => 'asdaaaasd'],
                    ['value' => 3, 'title' => 'asdaaaasd'],
                    ['value' => 4, 'title' => 'asdaaaasd'],
                    ['value' => 5, 'title' => 'asdaaaasd'],
                    ['value' => 6, 'title' => 'asdaaaasd'],
                ],
                'required'    => false,
                'placeholder' => 'Nama',
            ],
            [
                'title'    => 'Password',
                'type'     => 'file',
                'model'    => 'passwordaa',
                'required' => false,
                'step'     => '0.2',

            ],
            [
                'title'       => 'Email',
                'type'        => 'email',
                'model'       => 'email',
                'required'    => false,
                'placeholder' => '',
            ],
        ];
    }
}
