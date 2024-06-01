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
            'searchable' => true,
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


//        $link2 = route('transaction.transaction.change.status', [$data->id, 3]);

        return [
            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<div>
<div class='mb-3'>
<a href='' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'>Download</a>
</div>
<div>
<a href='#' class='py-1 px-2 bg-red-200  text-red-600 rounded-lg'>Kirim By Email</a>
</div>
</div>"],
            ['type' => 'raw_html', 'data' => "
            <span class='text-xl text-wishka-500 font-black'>
            <i class='ti ti-eye p-1'></i>
            <a href='#' wire:click='changeProduction($data->id,3)' class='p-1'><i class='ti ti-check'></i></a>
            <i class='ti ti-edit p-1'></i>
</span>
            "],
        ];
    }
}
