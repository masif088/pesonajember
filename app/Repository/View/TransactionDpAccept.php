<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class TransactionDpAccept extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 2);
        }) : static::query();
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
            ['label' => 'Tanggal', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Nama Customer', 'sort' => 'code'],
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Kwitansi', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {


        $link2 = route('transaction.download-kwitansi', $data->id);
//
//        <div>
//<a href='#' class='py-1 px-2 bg-red-200  text-red-600 rounded-lg'>Kirim By Email</a>
//</div>
        $link4 = route('finance.transaction.payment.detail', $data->id);
        return [
            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<div>
<div class='mb-3'>
<a href='$link2' target='_blank' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'>Download</a>
</div>

</div>"],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
            <a href='$link4' target='_blank' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>
            <a wire:click='changeTransaction($data->id,3)' href='#' class='py-1 px-2 bg-success text-white rounded-lg'><i class='ti ti-check'></i></a>
            </div>
            "],
        ];
    }
}
