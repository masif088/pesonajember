<?php

namespace App\Repository\ViewBackup;

use App\Models\TransactionList;
use App\Models\TransactionStatusAttachment;
use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class ProductionPicList extends TransactionStatusAttachment implements View
{
    protected $table = 'transaction_status_attachments';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $param = $params['param1'];

        $tsId = TransactionList::find($param)->transactionStatus->id;

        //        dd($tsId);
        return static::query()->where('transaction_status_id', $tsId)->where('key', 'pic');
    }

    public static function tableView(): array
    {
        return [
            'searchable' => false,
        ];
    }

    public static function tableField(): array
    {
        return [
            ['label' => '#', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Foto', 'sort' => 'code'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $pic = new $data->type();
        $pic = $pic->find($data->value)->name;
        return [
            ['type' => 'index', 'text-align' => 'center'],
            ['type' => 'raw_html', 'data' => "$pic"],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
            <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
