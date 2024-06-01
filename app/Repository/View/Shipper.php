<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Shipper extends \App\Models\Shipper implements View
{
    protected $table='shippers';
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
            ['label' => 'Nama Ekspedisi', 'sort' => 'title'],
            ['label' => 'Lokasi', 'sort' => 'location'],
            ['label' => 'No Hp', 'sort' => 'phone'],
            ['label' => 'Catatan', 'sort' => 'note'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        //        'title', 'note', 'location', 'phone'
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->phone],
            ['type' => 'string', 'data' => $data->location],
            ['type' => 'string', 'data' => $data->note],
            ['type' => 'string', 'data' => ''],
        ];
    }
}
