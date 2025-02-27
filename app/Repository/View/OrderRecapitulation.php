<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class OrderRecapitulation extends \App\Models\Order implements View
{
    protected $table = 'orders';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() :
            static::query()->where(function($q) use ($query){
                $q->where('order_number', 'like', "%$query%")
                    ->orWhereHas('transactionType',function (Builder $q) use ($query) {
                        $q->where('title', 'like', "%$query%");
                    })->orWhereHas('customer',function (Builder $q) use ($query) {
                        $q->where('company_name', 'like', "%$query%")
                            ->orWhere('name', 'like', "%$query%");
                    });
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
    public static function tableData($data = null,$params=[]): array
    {
        $linkEdit = route('admin.order.edit', $data->id);
        $buttonEdit = "<a href='$linkEdit' class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                       </a>";

        $linkPreview = route('admin.order.preview', $data->id);
        $buttonPreview = "<a href='$linkPreview' class='p-2 bg-blue-200 hover:bg-blue-100 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-blue-700' data-icon='icon-park-solid:transaction-order'></span>
                        </a>";
        $buttonShow='';
        $buttonDone='';
        $buttonMockup='';
        foreach ($data->orderProducts as $op){
            $linkShow = route('admin.order.show', $data->id);
            $buttonShow = "<a href='$linkShow' class='p-2 bg-green-100 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-green-900' data-icon='lsicon:view-filled'></span>
                       </a>";
            $linkMockup = route('admin.order.create-mockup', $data->id);
            $buttonMockup = "<a href='$linkMockup' class='p-2 bg-pink-100 hover:bg-pink-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-pink-900' data-icon='material-symbols:broken-image-outline'></span>
                       </a>";
        }
        if ($data->status==1){
            $linkDone = route('admin.order.order-status', $data->id);
            $buttonDone = "<a href='$linkDone' class='p-2 bg-green-900 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-white' data-icon='material-symbols:done-rounded'></span>
                       </a>";
        }

        $orderLast = \App\Models\Order::orderByDesc('id')->first();
        $buttonDelete='';
        if ($orderLast->id==$data->id && $data->status==0){
            $buttonDelete = "<a href='#' wire:click='deleteItem($data->id)' class='p-2 bg-red-200 hover:bg-red-100 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-red-900' data-icon='mingcute:delete-fill'></span>
                       </a>";
        }
        $status ='';
        switch ($data->status){
            case 0:
                $status = 'Draft';
                break;
                case 1:
                    $status = 'Aktif';
                    break;
                    case 2:
                        $status = 'Cancel';
                        break;
            case 3:
                $status = 'Selesai';
                break;
        }

        return [
            ['type' => 'string','data'=>$data->order_number],
            ['type' => 'string','data'=>$data->transactionType->title],
            ['type' => 'raw_html', 'data' => "
                <div class='text-md font-bold'>{$data->customer->company_name}</div>
                <div class='text-xs'><b>Nama</b> : {$data->customer->name}</div>
            "],
            ['type' => 'string','data'=>'Rp. '.number_format($data->orderProducts->sum('value'),2,',','.'). " ({$data->orderProducts->count()} item) "],
            ['type'=>'string','data'=>$status],
            ['type' => 'raw_html', 'data' =>
                "<div class='text-xl flex gap-1'>
                    <br>
                    $buttonEdit
                    $buttonPreview
                    $buttonShow
                    $buttonDelete
                    $buttonMockup
                    $buttonDone
                </div>"

            ],

        ];
    }
}
