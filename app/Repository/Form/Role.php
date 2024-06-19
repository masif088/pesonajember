<?php

namespace App\Repository\Form;

use App\Models\Status;
use App\Repository\Form;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements Form
{
    public static function formRules(): array
    {
        return [
            'form.role' => 'required|max:255',
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
                'model' => 'role',
                'required' => true,
                'class' => 'col-span-12',
            ],
        ];
    }
}
