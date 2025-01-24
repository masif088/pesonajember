<?php

namespace App\Repository\FormBackup;

use App\Models\AttendanceStatus;
use App\Repository\FormBackup;

class Attendance extends \App\Models\Attendance implements Form
{

//'master_id', 'user_id', '', '', '', 'entrance_attendance_by_fingerprint', 'discharge_attendance_by_fingerprint', 'note'
    public static function formRules(): array
    {
        return [

            'form.attendance_status_id' => 'required',
            'form.entrance_attendance_by_web' => 'nullable',
            'form.discharge_attendance_by_web' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
        $status = eloquent_to_options(AttendanceStatus::get());
        return [
            [
                'title' => 'Jam masuk',
                'type' => 'time',
                'model' => 'entrance_attendance_by_web',
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Jam pulang',
                'type' => 'time',
                'model' => 'discharge_attendance_by_web',
                'required' => false,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Status',
                'type' => 'select',
                'model' => 'attendance_status_id',
                'options' => $status,
                'required' => true,
                'class' => 'col-span-12',
            ],
        ];
    }
}
