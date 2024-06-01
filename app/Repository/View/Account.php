<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Account extends \App\Models\AccountName implements View
{
    protected $table='account_names';
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
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'code', 'sort' => 'code'],
            ['label' => 'Nama Account', 'sort' => 'title'],
            ['label' => 'level', 'sort' => 'level'],
            ['label' => 'Status', 'sort' => 'status_id'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->code],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->level],
            ['type' => 'string', 'data' => $data->status->title],
//            ['type' => 'string', 'data' => $data->additional_cost==1?'true':'false'],
            ['type' => 'string', 'data' => ''],
        ];
    }
}
