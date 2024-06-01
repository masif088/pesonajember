<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class GeneralInfo extends \App\Models\GeneralInfo implements View
{
    protected $table = 'general_infos';

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
            ['label' => 'Kata kunci', 'sort' => 'key'],
            ['label' => 'Content', 'sort' => 'value'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->key],
            ['type' => 'raw_html', 'data' => $data->value],
            ['type' => 'string', 'data' => ''],
        ];
    }
}
