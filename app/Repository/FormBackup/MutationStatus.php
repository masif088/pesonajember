<?php

namespace App\Repository\FormBackup;

use App\Repository\FormBackup;

class MutationStatus extends \App\Models\MaterialMutationStatus implements Form
{
    protected $table = 'material_mutation_statuses';

    public static function formRules(): array
    {
        return [
            'form.title' => 'required|max:255',
            'form.operation' => 'nullable',
            'form.note' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
        $status = [
            ['value'=>1, 'title'=>'Penambahan'],
            ['value'=>-1, 'title'=>'Pengurangan'],
            ['value'=>0, 'title'=>'Tidak melakukan perubahan'],
        ];
        $data = [
            [
                'title' => 'Judul mutasi',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Operasi',
                'type' => 'select',
                'model' => 'operation',
                'required' => true,
                'class' => 'col-span-6',
                'options'=>$status
            ],

            [
                'title' => 'Catatan',
                'type' => 'textarea',
                'model' => 'note',
                'required' => false,
                'class' => 'col-span-12',
            ],
        ];

        return $data;
    }
}
