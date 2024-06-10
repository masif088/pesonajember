<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionPacking extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 11);
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
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Produk Pesanan', 'sort' => 'code'],
            ['label' => 'Jumlah Pesanan', 'sort' => 'code'],
            ['label' => 'PIC', 'sort' => 'code'],
            ['label' => 'Berat Pengiriman', 'sort' => 'code'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $progress = '';

        $shipperWeight = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'berat pengiriman')->first();
//        $shipper = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'ekpedisi pengiriman')->first();

        $linkQc = route('transaction.shipper-edit', $data->id);
        $weight = "<a href='$linkQc' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input Berat</a>";
        if ($shipperWeight != null) {
            $weight = "$shipperWeight->value";
        }


        $status = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();

        $link3 = route('transaction.pic-edit', $data->id);
        $pic = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center'>Input PIC</a>";
        if ($status != null) {
            $progress = "
<select wire:change='changeProduction($data->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'>
<option></option>
<option value='12'>Produksi Selesai</option>
</select>";
            if ($status->type == 'string') {
                $pic = $status->value;
            }
            if ($status->type != 'string') {
                $pic = new $status->type();
                $pic = $pic->find($status->value)->name;
            }
        }


        $product = $data->transactionLists->where('transaction_detail_type_id', '=', 2)->first();
        $name = 'No Product (invalid transaction)';
        $amount = 0;
        if ($product != null) {
            $name = $product->product->title;
            $amount = $product->amount;
        }

        return [
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'string', 'text-align' => 'center', 'data' => $name],
            ['type' => 'string', 'text-align' => 'center', 'data' => $amount . 'pcs'],
            ['type' => 'raw_html', 'data' => $pic],
            ['type' => 'raw_html', 'data' => $weight],
            ['type' => 'raw_html', 'data' => $progress],
        ];
    }
}
