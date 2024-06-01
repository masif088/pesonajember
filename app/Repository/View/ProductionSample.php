<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionSample extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 5);
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
            ['label' => 'Nama Customer', 'sort' => 'code'],
            ['label' => 'Pengirim', 'sort' => 'code'],
            ['label' => 'Resi', 'sort' => 'code'],
            ['label' => 'Tracking', 'sort' => 'code'],
            ['label' => 'Ubah Proses', 'sort' => 'code'],
        ];
    }

    public static function tableData($data = null): array
    {


        $d = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'no resi')->first();

        $process ='Telah dikirim';
        if ($d==null){
            $tag = 'Belum Input';
            $link = route('transaction.mockup-site-edit',$data->id);
            $process = "<a href='$link' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Input Resi</a>";
        }else{
            $tag = $d->value;
        }
        $class = 'px-2 py-1 rounded-lg';
        if ($tag=="Revisi"){
            $class .= " bg-red-200 text-red-600 ";
        }
        if ($tag=="Disetujui"){
            $class .= " bg-wishka-200 text-wishka-400";
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
            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $process],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<div class='$class'>$tag</div>"],

            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $progress],
        ];
    }
}
