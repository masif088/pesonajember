<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionQc extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 10);
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
            ['label' => 'Mockup', 'sort' => 'code'],
            ['label' => 'PIC', 'sort' => 'code'],
            ['label' => 'QC', 'sort' => 'code'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {

        $progress = "";

        $qcStatus = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'qc')->first();
        $qcNote = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'qc note')->first();
        $linkQc = route('transaction.qc-edit',$data->id);
        $qc = "Belum input QC <br>
        <a href='$linkQc' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input QC</a>";
        if ($qcStatus != null) {
            if ($qcStatus->value == 'Sesuai standart') {
                $qc = "<div class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>$qcStatus->value</div>";
            } else {
                $qc = "<div class='py-1 px-2 bg-red-200  text-red-600 rounded-lg text-nowrap mb-3'>$qcStatus->value</div>
<a href='$linkQc' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input Ulang</a>
<div class='text-xs mt-1'>Note: $qcNote->value </div>
";
            }

        }

        $status = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();
        $link3 = route('transaction.pic-edit', $data->id);
        $pic = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input PIC</a>";
        if ($status != null) {
            $pic = $status->value;
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
            $mockupButton = '<a  class="px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap">Lihat mockup</a>';
        } else {
            $mockupButton = 'Mockup tidak ditemukan';
        }


        return [
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'string', 'text-align' => 'center', 'data' => $name],
            ['type' => 'string', 'text-align' => 'center', 'data' => $amount . 'pcs'],
            ['type' => 'raw_html', 'data' => $mockupButton],
            ['type' => 'raw_html', 'data' => $pic],
            ['type' => 'raw_html', 'data' => $qc],
            ['type' => 'raw_html', 'data' => $progress],
        ];
    }
}
