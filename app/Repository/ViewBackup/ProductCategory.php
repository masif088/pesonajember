<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class ProductCategory extends \App\Models\ProductCategory implements View
{
    protected $table='product_categories';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() : static::query()->where('name', 'like', "%$query%");
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

            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {

        $link = route('production.category.edit',$data->id);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'raw_html', 'data' =>"
            <a class='btn bg-wishka-400' href='$link'><i class='ti ti-pencil'></i></a>

            "],
            //            <a class='btn bg-red-600' href='#' wire:click='deleteItem($data->id)'><i class='ti ti-trash'></i></a>
        ];
    }
}
