<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class TransactionRepayment extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
//        dd("asd");

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->whereIn('transaction_status_type_id', [12,13]);
        }) : static::query();
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
            ['label' => 'Tanggal', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Nama Customer', 'sort' => 'code'],
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Status', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $status = $data->transactionStatus->transactionStatusType->title;
        $statusChange = $data->transactionStatus->transaction_status_type_id+1;
        $icon = 'ti ti-check';
        if ($statusChange==14){
            $icon= 'ti ti-truck-delivery';
        }
        return [
            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $status],
            ['type' => 'raw_html', 'data' => "
            <span class='text-xl text-wishka-500 font-black'>
            <i class='ti ti-eye p-1'></i>
            <a href='#' wire:click='changeProduction($data->id,$statusChange)' class='p-1'><i class='$icon'></i></a>

</span>
            "],
        ];
    }
}
