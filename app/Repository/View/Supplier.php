<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Supplier extends \App\Models\Supplier implements View
{
    protected $table='suppliers';
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
            ['label' => 'Kategori', 'sort' => 'supplier_category_id'],
            ['label' => 'Supplier', 'sort' => 'title'],
            ['label' => 'No HP', 'sort' => 'phone'],
            ['label' => 'Link', 'sort' => 'email'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $linkEdit = route('supplier.edit', $data->id);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->supplierCategory->title],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->phone],
            ['type' => 'string', 'data' => $data->email],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$linkEdit' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
