<?php

namespace App\Repository\View;

use App\Repository\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class UserAttendance extends \App\Models\Attendance implements View
{
    protected $table = 'attendances';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $user = $params['param1'];

        return static::query()->where('user_id', $user)->whereHas('master', function ($q) {
            $q->where('status', 'Hari Kerja');
        })->orderByDesc('id')->take(7);
    }

    public static function tableView(): array
    {
        return [
            'searchable' => false,
            'paginate' => false,
        ];
    }

    public static function tableField(): array
    {
        return [
            ['label' => 'Tanggal', 'sort' => 'name'],
            ['label' => 'Status kehadiran', 'sort' => 'name'],
            ['label' => 'Jam masuk', 'sort' => 'email'],
            ['label' => 'Jam pulang', 'sort' => 'role'],
        ];
    }

    public static function tableData($data = null): array
    {

        return [
            ['type' => 'string', 'data' => $data->master->attendance_date],
            ['type' => 'string', 'data' => $data->status->title],
            ['type' => 'string', 'data' => $data->entrance_attendance_by_web != null ? Carbon::parse(($data->entrance_attendance_by_web))->format('H:i') : '-'],
            ['type' => 'string', 'data' => $data->discharge_attendance_by_web != null ? Carbon::parse(($data->discharge_attendance_by_web))->format('H:i') : '-'],
        ];
    }
}
