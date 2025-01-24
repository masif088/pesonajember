<?php

namespace App\Repository\ViewBackup;

use App\Models\Transaction;
use App\Models\TransactionList;
use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class TransactionDelivery extends TransactionList implements View
{
    protected $table = 'transaction_lists';

    public static function tableSearch($params = null): Builder
    {
//        dd("asd");
        $query = $params['query'];
        //        dd("asd");

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', 13);
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
        $inputResi = "<a href='$linkQc' class='px-2  py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input Resi</a>";
        $progress = '';
        $weight = '';
        $shipperWeight = $data->transactionStatuses->where('transaction_status_type_id', 11)->first();
        if ($shipperWeight != null) {
            $weight = $shipperWeight->transactionStatusAttachments->where('key', '=', 'berat pengiriman')->first()->value ?? '';
        }
        //        dd($shipperWeight);
        //
        $status = 'Menunggu dikirim';
        $shipper = $data->transactionStatuses->where('transaction_status_type_id', 13)->first();
        if ($shipper != null) {

            if ($shipper->transactionStatusAttachments->where('key', '=', 'resi pengiriman')->first() != null) {
                $shipperResi = $shipper->transactionStatusAttachments->where('key', '=', 'resi pengiriman')->first()->value ?? '';
                $shipper = $shipper->transactionStatusAttachments->where('key', '=', 'ekpedisi pengiriman')->first()->value ?? '';
                $inputResi = "<div style='line-height: 25px'>
$shipper ($weight) -  $shipperResi  <br>
 <a href='$linkQc' class='px-2 py-1 rounded-lg bg-wishka-200  text-wishka-400 text-center text-nowrap'>Input Ulang Resi</a>
</div>";

                $progress = "
<div class='flex gap-3'>
<select wire:change='changeProduction($data->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'>
<option></option>
<option value='15'>Selesai</option>
</select>

</div>
";
                $linkShow = route('finance.transaction.payment.detail',$data->transaction->id);
                $status = "<div class='text-nowrap'>Barang dikirim <a href='$linkShow' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a></div>  ";

            }

        }

        //        if ($shipper != null) {
        //            $weight = "$shipperWeight->value ($shipper->value)";
        //        }



//        $pic = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();
//        if ($pic==null){
//            $link3 = route('transaction.pic-edit', $data->id);
//            $pic = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center'>Input PIC</a>";
//        }else{
//            $user = new $pic->type();
//            $pic = $user->find($pic->value)->name;
//        }

        $pic = '<ul class="list-disc" style="text-align: left">';
        $statuses = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic');
        foreach ($statuses as $s) {
            $pic0 = new $s->type();
            $pic .= '<li style="display: list-item">'.$pic0->find($s->value)->name.'</li>';
        }
        $pic .= '</ul>';

        if (auth()->user()->hasPermissionTo('tambah-pic', 'sanctum')) {
            $link3 = route('transaction.pic-edit', $data->id);
            $pic .= "<br> <a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input PIC</a>";
        }

        $product = $data;
        $name = 'No Product (invalid transaction)';
        $amount = 0;
        if ($product != null) {
            $name = $product->product->title;
            $amount = $product->amount;
        }

        return [
            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->transaction->customer->name],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $data->transaction->uid.'<br>'.$data->uid],
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
