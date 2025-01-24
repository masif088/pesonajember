<?php

namespace App\Repository\FormBackup;

use App\Repository\FormBackup;

class PaymentStatus extends \App\Models\PaymentStatus implements Form
{
    protected $table = 'payment_statuses';

    public static function formRules(): array
    {
        return [
            'form.title' => 'required|max:255',
            'form.note' => 'nullable',
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
                'title' => 'Judul kategori',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Catatan',
                'type' => 'textarea',
                'model' => 'note',
                'required' => false,
                'class' => 'col-span-12',
            ],
        ];
    }
}
