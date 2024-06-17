<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class TransactionDelivery extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
//        dd("asd");

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 14);
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
            ['label' => 'Tanggal', 'sort' => 'id', 'width' => '7%', 'text-align' => 'center'],
            ['label' => 'Nama Customer', 'sort' => 'code', 'text-align' => 'center'],
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Pic', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Resi & Ekepdisi', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Status', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {

        $linkQc = route('transaction.shipper-edit', $data->id);
        $inputResi = "<a href='$linkQc' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input Resi</a>";
        $progress = '';
        $weight ='';
        $shipperWeight = $data->transactionStatuses->where('transaction_status_type_id', 11)->first();
        if ($shipperWeight != null) {
            $weight = $shipperWeight->transactionStatusAttachments->where('key', '=', 'berat pengiriman')->first()->value??'';
        }
//        dd($shipperWeight);
//
        $status = "Menunggu dikirim";
        $shipper = $data->transactionStatuses->where('transaction_status_type_id',14)->first();
        if ($shipper!=null){

            if ($shipper->transactionStatusAttachments->where('key', '=', 'resi pengiriman')->first()!=null){
                $shipperResi=$shipper->transactionStatusAttachments->where('key', '=', 'resi pengiriman')->first()->value??'';
                $shipper=$shipper->transactionStatusAttachments->where('key', '=', 'ekpedisi pengiriman')->first()->value??'';
                $inputResi = "$shipper ($weight) <br>$shipperResi";
                    $progress = "
<select wire:change='changeProduction($data->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'>
<option></option>
<option value='15'>Selesai</option>
</select>";
                $status = "Barang dikirim";



            }

        }



//        if ($shipper != null) {
//            $weight = "$shipperWeight->value ($shipper->value)";
//        }

        $pic = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first()->value;
        if ($pic==null){
            $link3 = route('transaction.pic-edit', $data->id);
            $pic = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input PIC</a>";
        }



        $product = $data->transactionLists->where('transaction_detail_type_id', '=', 2)->first();
        $name = 'No Product (invalid transaction)';
        $amount = 0;
        if ($product != null) {
            $name = $product->product->title;
            $amount = $product->amount;
        }

        return [
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->customer->name],
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'raw_html', 'data' => $pic],
            ['type' => 'raw_html', 'data' => $inputResi],
            ['type' => 'raw_html', 'data' => $status],
            ['type' => 'raw_html', 'data' => $progress],
        ];

//        return [
//            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
//            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
//            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
//            ['type' => 'raw_html', 'text-align' => 'center', 'data' => 'Telah Lunas'],
//            ['type' => 'raw_html', 'data' => "
//            <span class='text-xl text-wishka-500 font-black'>
//            <i class='ti ti-eye p-1'></i>
//            </span>"],
//        ];
    }
}
