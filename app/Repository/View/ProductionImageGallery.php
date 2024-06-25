<?php

namespace App\Repository\View;

use App\Models\TransactionList;
use App\Models\TransactionStatusAttachment;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionImageGallery extends TransactionStatusAttachment implements View
{
    protected $table = 'transaction_status_attachments';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $param = $params['param1'];

        $tsId = TransactionList::find($param)->transactionStatus->id;
//        dd($tsId);
        return empty($query) ? static::query()->where('transaction_status_id', $tsId)->where('key','foto') : static::query();
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

        $image= asset(str_replace('public','storage',$data->value));
        return [
            ['type' => 'index', 'text-align' => 'center',],
            ['type' => 'raw_html', 'data' => "<img style='max-width: 300px; max-height: 200px' src='$image'>"],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
            <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
