<?php

namespace App\Repository\View;

use App\Models\Transaction;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class TransactionProduction extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
//        dd("asd");

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id','=',14);
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
            ['label' => 'Tanggal', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Nama Customer', 'sort' => 'code'],
            ['label' => 'Proses', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {

        $process = "Status";
        $list = "<br>";
        $listProcess = "<br>";
//        dd($data->transactionLists);
        foreach ($data->transactionLists->where('edit_count',$data->edit_count) as $tl ){

//            $listProcess.="$tl->uid <br>";
            $listProcess.="<b>$tl->uid</b>: ".$tl->transactionStatus->transactionStatusType->title ."<br>";
        }
//        $link3 = route('transaction.download', $data->id);
        $link4 = route('finance.transaction.payment.detail', $data->id);

        return [
            ['type' => 'raw_html', 'data' => $data->created_at->format('d/m/Y')."<br> $data->uid"],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],

            ['type' => 'raw_html', 'text-align' => 'left', 'data' => $process.$listProcess],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1 justify-center'>


            <a href='$link4' target='_blank' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>
<a wire:click='changeTransaction($data->id,15)' href='#' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-check'></i></a>
            </div>
            "],
        ];
    }
}
