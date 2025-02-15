<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;
use function PHPUnit\Framework\isEmpty;

class Invoice extends \App\Models\Order implements View
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
            ['label' => 'Status', 'sort' => 'status',],
            ['label' => 'Nominal transaksi','sort' ],
            ['label' => 'PIC', ],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null,$params=[]): array
    {

        $linkCreate = route('admin.invoice.create', [$params['param1'],$data->id]);
        $buttonCreate = "<a href='$linkCreate' class='p-2 bg-blue-100 hover:bg-blue-200 rounded-sm transition-[opacity,margin] text-blue-900 text-sm text-nowrap flex'>
                            <span class='iconify text-2xl' data-icon='material-symbols:input' style='margin-right: 5px'></span> Input
                       </a>";

        $linkShow = route('admin.order.show', [$data->id]);
        $buttonShow = "
        <div class='flex '>
                                <a href='$linkShow' target='_blank'
                                   class='bg-green-100 hover:bg-green-200 rounded px-4 py-2 text-nowrap flex text-green-900 text-sm'>
                                    <span class='iconify text-2xl' style='margin-right: 5px'
                                          data-icon='lsicon:view-filled'></span>
                                </a>
                            </div>
        ";

        $status = 'Invoice Belum dibuat';

        foreach ($data->orderInvoices as $oi){
            $linkCreate = route('admin.invoice.edit', [$params['param1'],$data->id,$oi->id]);
            $buttonCreate = "<a href='$linkCreate' class='p-2 bg-blue-100 hover:bg-blue-200 rounded-sm transition-[opacity,margin] text-blue-900 text-sm text-nowrap flex'>
                            <span class='iconify text-2xl' data-icon='material-symbols:input' style='margin-right: 5px'></span> Input Ulang
                       </a>";
            $linkDownload=route('admin.invoice.download',[$params['param1'],$oi->id]);
            $status = "
        <div class='flex '>
                                <a href='$linkDownload' target='_blank'
                                   class='bg-pink-100 hover:bg-pink-200 rounded px-4 py-2 text-nowrap flex text-pink-900'>
                                    <span class='iconify text-pink-900 text-2xl'
                                          data-icon='material-symbols:download'></span>
                                    <span>Download</span>
                                </a>
                            </div>
        ";
        }



        return [
            ['type' => 'string', 'data' => $data->order_number],
            ['type' => 'string', 'data' => $data->transactionType->title],
            ['type' => 'raw_html', 'data' => "
                <div class='text-md font-bold'>{$data->customer->company_name}</div>
                <div class='text-xs'><b>Nama</b> : {$data->customer->name}</div>
            "],
            ['type' => 'raw_html', 'data' => "$status"],


            ['type' => 'string', 'data' => "Rp. ".thousand_format($data->orderProducts->where('partner_id',$params['param1'])->sum('value'))],
            ['type' => 'string', 'data' => $data->user->name],
            ['type' => 'raw_html', 'data' =>
                "<div class='text-xl flex gap-1'>
                    <br>
                    $buttonCreate
                    $buttonShow
                </div>"
            ],
        ];
    }
}
