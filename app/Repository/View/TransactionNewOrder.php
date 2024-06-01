<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class TransactionNewOrder extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 1);
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
            ['label' => 'No Pesanan', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Nama Customer', 'sort' => 'code'],
            ['label' => 'Status Dokumen', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Total Tagihan', 'sort' => 'email'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $d = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'status document')->first()->value;
        $c = 'bg-wishka-600';
        if ($d == 'Lakukan penagihan') {
            $c = 'bg-error';
        }
        $total = 0;

        foreach ($data->transactionLists as $tl) {
            if ($tl->transaction_detail_type_id == 1) {
                $total += $tl->price;
            } else {
                $total += ($tl->price * $tl->amount);
            }
        }
        $total += ($total * $data->tax / 100);
        $link = route('transaction.billing-page', $data->id);
        $link2 = route('transaction.transaction.change.status', [$data->id, 2]);

        return [
            ['type' => 'string', 'data' => $data->uid],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<a href='$link' class=' $c text-white px-2 py-2 rounded-lg w-full'>$d</a>"],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($total)],
            ['type' => 'raw_html', 'data' => "
            <span class='text-xl text-wishka-500 font-black'>
            <i class='ti ti-eye p-1'></i>
            <a wire:click='changeProduction($data->id,2)' href='#' class='p-1'><i class='ti ti-check'></i></a>
            <i class='ti ti-edit p-1'></i>
            <i class='ti ti-trash p-1'></i>
            </span>
            "],
        ];
    }
}
