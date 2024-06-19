<?php

namespace App\Repository\Form;

use App\Repository\Form;
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
                'title' => 'Nama Role',
                'type' => 'text',
                'model' => 'permission',
                'required' => true,
                'class' => 'col-span-12',
            ],
        ];
    }
}
