<?php

namespace App\Repository\FormBackup;

use App\Repository\FormBackup;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements Form
{
    public static function formRules(): array
    {
        return [
            'form.permission' => 'required|max:255',
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
                'title' => 'Nama Izin',
                'type' => 'text',
                'model' => 'permission',
                'required' => true,
                'class' => 'col-span-12',
            ],
        ];
    }
}
