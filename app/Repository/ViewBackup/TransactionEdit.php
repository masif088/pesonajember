<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class TransactionEdit extends \App\Models\Transaction implements View
{
    protected $table='transactions';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        //        dd("asd");

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '!=', 15)->where('transaction_status_type_id', '!=', 17);
        }) : static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '!=', 15)->where('transaction_status_type_id', '!=', 17);
        })->where(function (Builder $q) use ($query) {
            $q->whereHas('customer', function (Builder $q2) use ($query) {
                $q2->where('name', 'like', "%$query%");
            })->orWhere('uid', 'like', "%$query%");
        });
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
            ['label' => 'No Pesanan'],
            ['label' => 'Nama Customer'],
            ['label' => 'Status', 'text-align'],
            ['label' => 'Transaksi Keseluruhan'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $total = 0;

        foreach ($data->transactionLists as $tl) {
            if ($tl->transaction_detail_type_id == 1) {
                $total += $tl->price;
            } else {
                $total += ($tl->price * $tl->amount);
            }
        }
        $total += ($total * $data->tax / 100);
        $link = route('finance.transaction.payment.detail', $data->id);
        $link2 = route('finance.transaction.payment', $data->id);
        $link5 = route('transaction.edit', $data->id);
        return [
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $data->uid .' <br>' .$data->created_at->format('d/m/Y')],

            ['type' => 'raw_html', 'data' => $data->customer->name . " <br> <span class='text-sm'>" . $data->customer->email . '</span>'],
            ['type' => 'raw_html', 'data' => "<font class='text-nowrap'>" . $data->transactionStatus->transactionStatusType->title . "</font>"],
            ['type' => 'raw_html', 'data' => '<span class="text-nowrap">Rp. ' . thousand_format($total) . '</span>'],
            ['type' => 'raw_html', 'data' => "
                <div class='flex gap-1'>

                <a href='$link5' target='_blank' class='py-1 px-2 bg-warning text-white rounded-lg text-xl'><i class='ti ti-pencil'></i></a>

                </div>

            "],
        ];
    }
}
