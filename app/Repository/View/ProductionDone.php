<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Models\TransactionList;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionDone extends TransactionList implements View
{
    protected $table = 'transaction_lists';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 12);
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
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Produk Pesanan', 'sort' => 'code'],
            ['label' => 'Jumlah Pesanan', 'sort' => 'code'],
            ['label' => 'Status', 'sort' => 'code'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        //        $d = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'status document')->first()->value;

        $product = $data;
        $name = 'No Product (invalid transaction)';
        $amount = 0;
        if ($product != null) {
            $name = $product->product->title;
            $amount = $product->amount;
        }

        $status = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();

        $link3 = route('transaction.pic-edit', $data->id);
        $pic = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center'>Input PIC</a>";
        if ($status != null) {
            if ($status->type == 'string') {
                $pic = $status->value;
            }
            if ($status->type != 'string') {
                $pic = new $status->type();
                $pic = $pic->find($status->value)->name;
            }
        }


        $mockup =  $data->transactionStatuses->where('transaction_status_type_id','=',3)->first();
        if ($mockup!=null){
            $mockupButton = '<a  class="px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400">Lihat mockup</a>';
        }else{
            $mockupButton = 'Mockup tidak ditemukan';
        }
        $progress = "
<select wire:change='changeProduction($data->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'>
<option></option>
<option value='13'>Pengiriman</option>
</select>";

        return [
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $data->transaction->uid.'<br>'.$data->uid],
            ['type' => 'string', 'text-align' => 'center', 'data' => $name],
            ['type' => 'string', 'text-align' => 'center', 'data' => $amount.'pcs'],
            ['type' => 'raw_html', 'data' => "Menunggu pembayaran"],
            ['type' => 'raw_html', 'data' => $progress],
        ];
    }
}
