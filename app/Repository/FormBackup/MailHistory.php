<?php

namespace App\Repository\FormBackup;

use App\Models\Status;
use App\Repository\FormBackup;

class MailHistory extends \App\Models\MailHistory implements Form
{
//'type_mail', 'model_type', 'model_id', 'mail', 'title', 'content'

    public static function formRules(): array
    {
        return [
            'form.mail' => 'required',
            'form.title' => 'required',
            'form.content' => 'nullable',
            'form.attachment' => 'nullable',
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
                'title' => 'Alamat email',
                'type' => 'email',
                'model' => 'mail',
                'required' => true,
                'class' => 'col-span-12',
            ],[
                'title' => 'Judul email',
                'type' => 'title',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Isi email',
                'type' => 'textarea',
                'model' => 'content',
                'class' => 'col-span-12',
            ],
        ];

        return $data;
    }
}
