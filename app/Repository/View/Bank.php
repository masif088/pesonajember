<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Bank extends \App\Models\Bank implements View
{
    protected $table='banks';
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
//        'bank_name','account_number', 'account_in_name', 'note', 'status_id'
        return [
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Nama Bank', 'sort' => 'bank_name'],
            ['label' => 'Nomer Rekening', 'sort' => 'account_in_name'],
            ['label' => 'status', 'sort' => 'status_id'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $link = route('bank.edit',$data->id);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->bank_name],
            ['type' => 'raw_html', 'data' => "<div>$data->account_number</div><div style='font-size: 12px'>$data->account_in_name</div>"],
            ['type' => 'string', 'data' => $data->status->title],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$link' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
