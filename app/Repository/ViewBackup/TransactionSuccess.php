<?php

namespace App\Repository\ViewBackup;

use App\Models\Transaction;
use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class TransactionSuccess extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
//        dd("asd");

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id','>=',2)->where('transaction_status_type_id','<=',14);
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
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Status', 'text-align' => 'center', 'sort' => 'title'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        return [
            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => 'Telah Lunas'],
            ['type' => 'raw_html', 'data' => "
            <span class='text-xl text-wishka-500 font-black'>
            <i class='ti ti-eye p-1'></i>
            </span>"],
        ];
    }
}
