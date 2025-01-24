<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class SupplierCategory extends \App\Models\SupplierCategory implements View
{
    protected $table='supplier_categories';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() : static::query()->where('title', 'like', "%$query%")
            ;
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
        $link = route('supplier.category.edit',$data->id);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->note],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$link' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
