<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class AttendanceMaster extends \App\Models\AttendanceMaster implements View
{

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query()->orderByDesc('attendance_date') : static::query()
            ->where('title','like',"%$query%")
            ->orWhere('code','like',"%$query%")
            ->orWhere('level','like',"%$query%")
            ;
    }

    public static function tableView(): array
    {
        return [
            'searchable' => false,
        ];
    }

    public static function tableField(): array
    {
        return [
            ['label' => 'Tanggal', ],
            ['label' => 'Masuk', 'text-align'=>'center'],
            ['label' => 'Terlambat', 'text-align'=>'center'],
            ['label' => 'Absen', 'text-align'=>'center'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $link = route('attendance.show',$data->id);

        return [
            ['type' => 'string', 'data' => $data->attendance_date],
            ['type' => 'string', 'text-align'=>'center','data' => $data->attendances->where('attendance_status_id',1)->count()+$data->attendances->where('attendance_status_id',6)->count()],
            ['type' => 'string', 'text-align'=>'center', 'data' => $data->attendances->where('attendance_status_id',6)->count()],
            ['type' => 'string',  'text-align'=>'center','data' => $data->attendances->where('attendance_status_id',7)->count()],

            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$link' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-eye'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
