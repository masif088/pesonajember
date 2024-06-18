<?php

namespace App\Repository\Form;

use App\Models\Status;
use App\Repository\Form;

class AttendanceMaster extends \App\Models\AttendanceMaster implements Form
{


    public static function formRules(): array
    {
        return [

            'form.attendance_date' => 'required',
            'form.status' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

        //            'attendance_date', 'status'
        $status = [
            ['value'=>'Libur', 'title'=>'Libur'],
            ['value'=>'Hari Kerja', 'title'=>'Hari Kerja'],
            ['value'=>'Akhir Pekan', 'title'=>'Akhir Pekan'],
        ];
        return [
            [
                'title' => 'Tanggal',
                'type' => 'date',
                'model' => 'attendance_date',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Status',
                'type' => 'select',
                'model' => 'status',
                'options' => $status,
                'required' => true,
                'class' => 'col-span-12',
            ],
        ];
    }
}
