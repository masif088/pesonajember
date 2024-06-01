<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionCut extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 6);
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
            ['label' => 'Jumlah Pesanan', 'text-align' => 'center', 'sort' => 'code'],
            ['label' => 'Mockup', 'sort' => 'code'],
            ['label' => 'PIC', 'sort' => 'code'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        //        $d = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'status document')->first()->value;
        $status = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();

        $link3=route('transaction.pic-edit',$data->id);
        $pic = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center'>Input PIC</a>";
        if ($status != null) {
            $pic = $status->value;
        }

        $product = $data->transactionLists->where('transaction_detail_type_id', '=', 2)->first();
        $name = 'No Product (invalid transaction)';
        $amount = 0;
        if ($product != null) {
            $name = $product->product->title;
            $amount = $product->amount;
        }


        $mockup = $data->transactionStatuses->where('transaction_status_type_id', '=', 3)->first();

        if ($mockup != null) {
            $link2 = route('transaction.mockup-site-download',$data->id);
            $mockupButton = "<a href='$link2' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Lihat Mockup</a>";
        } else {
            $mockupButton = 'Mockup tidak ditemukan';
        }
        $progress = "
<select wire:change='changeProduction($data->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'>
<option></option>
<option value='3'>Mockup</option>
<option value='4'>Pola</option>
<option value='5'>Sampel</option>
<option value='6'>Potong</option>
<option value='7'>Print</option>
<option value='8'>Pasang Label</option>
<option value='9'>Jahit</option>
<option value='10'>Quality Control</option>
<option value='11'>Packing</option>
<option value='12'>Menunggu Pembayaran</option>
</select>";

        return [
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'string', 'text-align' => 'start', 'data' => $name],
            ['type' => 'string', 'text-align' => 'center', 'data' => $amount.'pcs'],
            ['type' => 'raw_html', 'data' => $mockupButton],
            ['type' => 'raw_html', 'data' => $pic],
            ['type' => 'raw_html', 'data' => $progress],
        ];
    }
}
