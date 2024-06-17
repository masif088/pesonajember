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
        return empty($query) ? static::query() :
            static::query()
                ->where('title', 'like', "%$query%")
                ->orWhere('location', 'like', "%$query%")
                ->orWhere('phone', 'like', "%$query%")
                ->orWhere('note', 'like', "%$query%")
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
            ['label' => 'Nama Ekspedisi', 'sort' => 'title'],
            ['label' => 'Lokasi', 'sort' => 'location'],
            ['label' => 'No Hp', 'sort' => 'phone'],
            ['label' => 'Catatan', 'sort' => 'note'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $linkEdit = route('shipper.edit', $data->id);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->phone],
            ['type' => 'string', 'data' => $data->location],
            ['type' => 'string', 'data' => $data->note],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$linkEdit' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
