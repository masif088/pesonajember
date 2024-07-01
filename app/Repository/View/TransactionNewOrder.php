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
            'searchable' => false,
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

        foreach ($data->transactionLists->where('edit_count',$data->edit_count) as $tl) {
            if ($tl->transaction_detail_type_id == 1) {
                $total += $tl->price;
            } else {
                $total += ($tl->price * $tl->amount);
            }
        }
        $total += ($total * $data->tax / 100);
        $link = route('transaction.billing-page', $data->id);
        $link3 = route('transaction.download', $data->id);
        $link4 = route('finance.transaction.payment.detail', $data->id);
        $link5 = route('transaction.edit', $data->id);

        return [
            ['type' => 'string', 'data' => $data->uid],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<a href='$link' class=' $c text-white px-2 py-2 rounded-lg w-full'>$d</a>"],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($total)],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
            <a wire:click='changeTransaction($data->id,2)' href='#' class='py-1 px-2 bg-success text-white rounded-lg'><i class='ti ti-check'></i></a>
            <a href='$link3' target='_blank' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'><i class='ti ti-download'></i></a>
            <a href='$link5' target='_blank' class='py-1 px-2 bg-warning text-white rounded-lg'><i class='ti ti-pencil'></i></a>
            <a href='$link4' target='_blank' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>
            <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg' ><i class='ti ti-trash'></i></a>
            </div>
            "],
            //            <i class='ti ti-edit p-1'></i>

        ];
    }
}
