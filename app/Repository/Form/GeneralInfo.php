<?php

namespace App\Repository\Form;

use App\Models\Status;
use App\Repository\Form;

class GeneralInfo extends \App\Models\GeneralInfo implements Form
{
    protected $table = 'general_infos';

    public static function formRules(): array
    {
        return [
            'form.key' => 'required',
            'form.value' => 'required',
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
                'title' => 'Kata kunci',
                'type' => 'text',
                'model' => 'key',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Content',
                'type' => 'textarea',
                'model' => 'value',
                'required' => true,
                'placeholder' => '',
                'class' => 'col-span-12',
            ],
        ];

        return $data;
    }
}
