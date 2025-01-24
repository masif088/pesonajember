<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Order extends \App\Models\Order implements View
{
    protected $table = 'orders';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() :
            static::query()->where('order_number', 'like', "%$query%")
                ->orWhereHas('transactionType',function (Builder $q) use ($query) {
                    $q->where('title', 'like', "%$query%");
                })->orWhereHas('customer',function (Builder $q) use ($query) {
                    $q->where('company_name', 'like', "%$query%")
                        ->orWhere('name', 'like', "%$query%");
                });

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
            ['label' => 'Nomer Transaksi', 'sort' => 'order_number', 'width' => '10%'],
            ['label' => 'Jenis Transaksi', 'sort' => 'transaction_type_id'],
            ['label' => 'Nama Perusahaan', 'sort' => 'customer.name',],
            ['label' => 'Nominal Kontrak',],
            ['label' => 'Status','sort' => 'status',],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $linkEdit = route('admin.order.edit', $data->id);
        $buttonEdit = "<a href='$linkEdit' class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                       </a>";
        $linkShow = route('admin.order.show', $data->id);
        $buttonShow = "<a href='$linkShow' class='p-2 bg-green-100 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-green-900' data-icon='lsicon:view-filled'></span>
                       </a>";

        return [
            ['type' => 'string','data'=>$data->order_number],
            ['type' => 'string','data'=>$data->transactionType->title],

            ['type' => 'raw_html', 'data' => "
                <div class='text-md font-bold'>{$data->customer->company_name}</div>
                <div class='text-xs'><b>Nama</b> : {$data->customer->name}</div>
                <div class='text-xs'><b>Nomer HP</b> :{$data->customer->phone}</div>
                <div class='text-xs'><b>Email</b> : {$data->customer->email}</div>
            "],
            ['type' => 'string','data'=>'Rp. '.number_format($data->orderProducts->sum('value'),2,',','.'). " ({$data->orderProducts->count()} item) "],
            ['type'=>'string','data'=>$data->status?'Aktif':'Tidak Aktif'],
            ['type' => 'raw_html', 'data' =>
                "<div class='text-xl flex gap-1'>
                    <br>
                    $buttonEdit
                    $buttonShow
                </div>"
            ],

        ];
    }
}
