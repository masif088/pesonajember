<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class OrderMargin extends \App\Models\Order implements View
{
    protected $table = 'orders';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $transactionTypeId = $params['param1'];
//        dd($transactionTypeId);
        return empty($query) ? static::query()->where('status',1)->where('transaction_type_id',$transactionTypeId) :
            static::query()->where('status',1)->where('transaction_type_id',$transactionTypeId) ->where(function (Builder $q) use ($query) {
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
            ['label' => 'Nama Perusahaan', 'sort' => 'customer.name',],
            ['label' => 'Nominal Kontrak',],
            ['label' => 'Harga Setelah Pajak','width'=>'30%'],
            ['label' => 'Jumlah HPP',],
            ['label' => 'Sharing',],
            ['label' => 'Laba/Rugi',],
            ['label' => 'PIC',],
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

        $linkShow = route('admin.order.show', $data->id);
        $buttonShow = "<a href='$linkShow' class='p-2 bg-green-100 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-green-900' data-icon='lsicon:view-filled'></span>
                       </a>";
        $orderLast = \App\Models\Order::orderByDesc('id')->first();
        $buttonDelete='';
        if ($orderLast->id==$data->id && $data->status==0){
            $buttonDelete = "<a href='$linkShow' class='p-2 bg-red-200 hover:bg-red-100 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-red-900' data-icon='mingcute:delete-fill'></span>
                       </a>";
        }
        $allContractValue = $data->orderProducts->sum('value');
        $allHppValue = $data->orderProducts->sum('hpp_value');
        $allSharing= 0;
        $ppn =  11;
        $pph = 1.5;
        $dpp =$allContractValue*100/(100+$ppn);
        $ppnProduct = $allContractValue - $dpp;
        $pphProduct = $pph*$dpp/100;
        $afterTax = $dpp - $pphProduct;

        $ppnProduct = thousand_format($ppnProduct);
        $pphProduct = thousand_format($pphProduct);
        $dpp = thousand_format($dpp);

        $margin = $afterTax-$allHppValue-$allSharing;
        //belum kelar

        $marginPresentation = number_format($margin/$allContractValue*100,2,',','.');
        $margin = thousand_format($margin);

        if ($allHppValue==0){
            $l =  route('admin.order.hpp',$data->id);
            $hpp = "<a href='$l' class='bg-green-100 hover:bg-green-200 text-green-900 text-nowrap rounded px-5 py-1'>Input HPP</a>";
        }else{
            $hpp= 'Rp.'.thousand_format($allHppValue);
        }

        if ($allSharing==0){
            $l =  route('admin.order.sharing',$data->id);
            $sharing = "<a href='$l' class='bg-green-100 hover:bg-green-200 text-green-900 text-nowrap rounded px-5 py-1'>Input Sharing</a>";
        }else{
            $sharing= 'Rp.'.thousand_format($allSharing);
        }


        return [
            ['type' => 'string','data'=>$data->order_number],
            ['type' => 'raw_html', 'data' => "
                <div class='text-md font-bold text-nowrap'>{$data->customer->company_name}</div>
                <div class='text-xs text-nowrap'><b>Nama</b> : {$data->customer->name}</div>

            "],
            ['type' => 'raw_html','data'=>'Rp. '.number_format($allContractValue,2,',','.'). " ({$data->orderProducts->count()} item) "],
//            ['type'=>'string','data'=>$data->status?'Aktif':'Draft'],
//            ['type' => 'raw_html', 'data' =>
//                "<div class='text-sm'>
//                    <div class='text-nowrap'>DPP: Rp. $dpp</div>
//                    <div class='text-nowrap'>PPN($ppn%): Rp. $ppnProduct</div>
//                    <div class='text-nowrap'>PPH($pph%): Rp. $pphProduct</div>
//                </div>"
//            ],
            ['type' => 'string','data'=>'Rp.'.thousand_format($afterTax)],
            ['type' => 'raw_html','data'=>$hpp],
            ['type' => 'raw_html','data'=>$sharing],
            ['type' => 'raw_html','data'=>"<div class='text-nowrap'>Rp. $margin <br> Profit Margin: $marginPresentation%</div>"],
            ['type' => 'string','data'=>'Rp.'.thousand_format($allHppValue)],
            ['type' => 'raw_html', 'data' =>
                "<div class='text-xl flex gap-1'>
                    <br>
                    $buttonEdit
                    $buttonPreview
                    $buttonShow
                    $buttonDelete
                </div>"
            ],

        ];
    }
}
