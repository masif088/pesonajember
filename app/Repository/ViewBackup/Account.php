<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class Account extends \App\Models\AccountName implements View
{
    protected $table='account_names';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() : static::query()
            ->where('title','like',"%$query%")
            ->orWhere('code','like',"%$query%")
            ->orWhere('level','like',"%$query%")
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
            ['label' => 'code', 'sort' => 'code'],
            ['label' => 'Nama Account', 'sort' => 'title'],
            ['label' => 'level', 'sort' => 'level'],
            ['label' => 'Status', 'sort' => 'status_id'],
            ['label' => 'Eksternal cost', 'sort' => 'additional_cost'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $link = route('finance.account-names.edit',$data->id);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->code],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $data->level],
            ['type' => 'string', 'data' => $data->status->title],
            ['type' => 'string', 'data' => ($data->additional_cost==1)?'Iya':'Tidak'],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$link' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
