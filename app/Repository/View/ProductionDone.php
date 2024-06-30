<?php

namespace App\Repository\View;

use App\Models\TransactionList;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionDone extends TransactionList implements View
{
    protected $table = 'transaction_lists';

    public static function tableSearch($params = null): Builder
    {
        return static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 12);
        })->whereHas('transaction', function (Builder $q) {
            $q->whereHas('transactionStatus', function (Builder $q2) {
                $q2->where('transaction_status_type_id', 14);
            });
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
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Produk Pesanan', 'sort' => 'code'],
            ['label' => 'Jumlah Pesanan', 'sort' => 'code'],
            ['label' => 'Status', 'sort' => 'code'],
            ['label' => 'Acuan kerja'],
            ['label' => 'Progress'],
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

        $progress = "
<select wire:change='changeProduction($data->id,event.target.value)' wire:model.live='cpLive' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'>
<option></option>
<option value='13'>Pengiriman</option>
</select>";
        $link4 = route('transaction.image-gallery', $data->id);
        $link5 = route('transaction.image-edit', $data->id);


        $mockupButton = 'Mockup tidak ditemukan';
        $mockup = $data->transaction->transactionStatuses->where('transaction_status_type_id', '=', 3)->first();
        if ($mockup != null) {
            $mockup = $mockup->transactionStatusAttachments->where('key', 'pdf mockup')->first();
            if ($mockup != null) {
                $link2 = route('customer.transaction-download-pdf', base64_encode($mockup->value));
                $mockupButton = "<a href='$link2' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Mockup</a>";
            }
        }
        $mockupButton = 'Mockup tidak ditemukan';
        $mockup = $data->transaction->transactionStatuses->where('transaction_status_type_id', '=', 3)->first();
        if ($mockup != null) {
            $mockup = $mockup->transactionStatusAttachments->where('key', 'pdf mockup')->first();
            if ($mockup != null) {
                $link2 = route('customer.transaction-download-pdf', base64_encode($mockup->value));
                $mockupButton = "<a href='$link2' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Mockup</a>";
            }
        }

        $link3 = route('transaction.mockup-site-download', $data->id);
        $worksheetButton = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Worksheet</a>";

        return [
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $data->transaction->uid.'<br>'.$data->uid],
            ['type' => 'string', 'text-align' => 'center', 'data' => $name],
            ['type' => 'string', 'text-align' => 'center', 'data' => $amount.'pcs'],
            ['type' => 'raw_html', 'data' => 'Menunggu pembayaran'],
            ['type' => 'raw_html', 'data' => "<div class='flex gap-1 flex-wrap'>$mockupButton $worksheetButton</div>"],
            ['type' => 'raw_html', 'data' => $progress],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
            <a href='$link5' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'><i class='ti ti-photo-up'></i></a>
            <a href='$link4' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'><i class='ti ti-album'></i></a>
            </div>
            "],
        ];
    }
}
