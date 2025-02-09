<?php

namespace App\Repository\Form;

use App\Models\OrderMockup;
use App\Models\User;
use App\Repository\Form;
use Carbon\Carbon;

class Mockup extends OrderMockup implements Form
{
    protected $table = 'order_mockups';
    public static function formRules(): array
    {
        return [
            'form.title'=>'required|max:255',
            'form.mockup_file'=>'mimes:jpeg,bmp,png,gif,svg,pdf',
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
                'title' => 'Judul mockup',
                'type' => 'text',
                'model' => 'title',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'File mockup',
                'type' => 'file',
                'model' => 'mockup_file',
                'accept'=>'.pdf,image,image/jpeg,image/jpg,image/png,image/gif',
                'class' => 'col-span-12',
            ],
        ];
    }
}
