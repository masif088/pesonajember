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
        $link = route('finance.account-names.edit');
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->code],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->level],
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
