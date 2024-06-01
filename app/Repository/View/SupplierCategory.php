<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class SupplierCategory extends \App\Models\SupplierCategory implements View
{
    protected $table='supplier_categories';
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
            ['label' => 'title', 'sort' => 'title'],
            ['label' => 'note', 'sort' => 'note'],

            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->note],
            ['type' => 'string', 'data' => ''],
        ];
    }
}
