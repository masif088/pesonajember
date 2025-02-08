<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProofOfCash extends \App\Models\Order implements View
{
    protected $table = 'orders';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $partnerId = $params['param1'];
        return empty($query) ? static::query()->where('status', 1)->whereHas('orderPartners', function (Builder $query) use ($partnerId) {
            $query->where('partner_id', $partnerId);
        }) : static::query()->where('status', 2)->where('status', 2)->whereHas('orderPartners', function (Builder $query) use ($partnerId) {
            $query->where('partner_id', $partnerId);
        })->where(function (Builder $q) use ($query) {
            $q->where('order_number', 'like', "%$query%")->orWhereHas('transactionType', function (Builder $q) use ($query) {
                $q->where('title', 'like', "%$query%");
            })->orWhereHas('customer', function (Builder $q) use ($query) {
                $q->where('company_name', 'like', "%$query%")->orWhere('name', 'like', "%$query%");
            });
        });
    }

    public static function tableView(): array
    {
        return ['searchable' => true,];
    }

    public static function tableField(): array
    {
        return [
            ['label' => 'Nomer Transaksi', 'sort' => 'order_number', 'width' => '10%'],
            ['label' => 'Jenis Transaksi', 'sort' => 'transaction_type_id'],
            ['label' => 'Nama Perusahaan', 'sort' => 'customer.name',],
            ['label' => 'PIC', 'sort' => 'status',],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null,$params=[]): array
    {

        $linkShow = route('admin.proof-of-cash.show', [$params['param1'],$data->id]);
        $buttonShow = "<a href='$linkShow' class='p-2 bg-green-100 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-green-900' data-icon='lsicon:view-filled'></span>
                       </a>";



        return [
            ['type' => 'string', 'data' => $data->order_number],
            ['type' => 'string', 'data' => $data->transactionType->title],
            ['type' => 'raw_html', 'data' => "
                <div class='text-md font-bold'>{$data->customer->company_name}</div>
                <div class='text-xs'><b>Nama</b> : {$data->customer->name}</div>
            "],

            ['type' => 'string', 'data' => $data->user->name],
            ['type' => 'raw_html', 'data' =>
                "<div class='text-xl flex gap-1'>
                    <br>
                    $buttonShow
                </div>"
            ],
        ];
    }
}
