<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Customer extends \App\Models\Customer implements View
{
    protected $table='customers';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() : static::query();
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {
//        'bank_name','account_number', 'account_in_name', 'note', 'status_id'
        return [
            ['label' => 'ID Konsumen', 'sort' => 'uid'],
            ['label' => 'Nama Konsumen', 'sort' => 'name'],
            ['label' => 'Alamat', 'sort' => 'address'],
            ['label' => 'Jumlah transaksi'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $link = route('customer.edit',$data->id);
        return [
            ['type' => 'string','data'=>$data->uid],
            ['type' => 'raw_html', 'data' => "$data->name <br> <span class='font-sm'>$data->email</span>" ],
            ['type' => 'raw_html', 'data' => "$data->address $data->postal_code<br> <span class='font-sm'> $data->province, $data->city, $data->district</span>"],
            ['type' => 'string','text-align'=>'center', 'data' => $data->transactions->count()],
            ['type' => 'raw_html', 'data' =>
            "<a class='btn bg-wishka-400' href='$link'><i class='ti ti-pencil'></i></a>"
            ],
        ];
    }
}
