<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class TransactionHistory extends \App\Models\Transaction implements View
{
    protected $table='transactions';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 15)->orWhere('transaction_status_type_id', '=', 17);
        }) :  static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 15)->orWhere('transaction_status_type_id', '=', 17);
        })->where(function (Builder $q) use ($query) {
            $q->whereHas('customer',function (Builder $q2)use ($query){
                $q2->where('name','like',"%$query%");
            })->orWhere('uid','like',"%$query%");
        });
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
            ['label' => 'No Pesanan'],
            ['label' => 'Tanggal', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Nama Customer'],
            ['label' => 'Status', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Transaksi Keseluruhan', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Uang yang telah terbayar', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {$total = 0;

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
        return [
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'raw_html', 'data' => $data->customer->name . " <br> <span class='text-sm'>" . $data->customer->email . '</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<font class='text-nowrap'>" . $data->transactionStatus->transactionStatusType->title . "</font>"],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => '<span class="text-nowrap">Rp. ' . thousand_format($total) . '</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => '<span class="text-nowrap">Rp. ' . thousand_format($data->transactionPayments->sum('amount')) . '</span>'],
            ['type' => 'raw_html', 'data' => "
                <div class='flex gap-1'>
                    <a href='$link' class='btn bg-wishka-400 text-wishka-500 font-black text-nowrap flex justify-center'><i class='ti ti-eye text-xl'></i> <font style='margin: auto'> Detail Pembayaran</font></a>
                </div>

            "],
        ];
    }
}
