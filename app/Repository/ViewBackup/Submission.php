<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class Submission extends \App\Models\Submission implements View
{
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query() : static::query();
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {
        return [
            ['label' => 'Tanggal', 'sort' => 'created_at'],
            ['label' => 'Judul Pengajuan', 'sort' => 'title'],
            ['label' => 'PIC', 'sort' => 'user_id'],
            ['label' => 'Nominal',],
            ['label' => 'Status', 'sort' => 'submission_status_id'],
            ['label' => 'Tindakan', 'text-align' => 'center'],
        ];
    }

    public static function tableData($data = null): array
    {
        $linkStock = route('material.material-stock', $data->id);

//        dd($data);
        $total  = 0;
        foreach ($data->submissionDetails  as $sd){
            $total+=$sd->amount*$sd->price;
        }

        $link = route('submission.show',$data->id);

        return [
            ['type' => 'string', 'data' => $data->created_at],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->user->name],
            ['type' => 'string', 'data' => thousand_format($total)],
            ['type' => 'string', 'data' => $data->submissionStatus->title],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "
            <div>
            <a href='$link' class='btn bg-wishka-600 pr-5 pl-5 w-[400px]' >Lihat </a>
</div>
            "],
        ];
    }
}
