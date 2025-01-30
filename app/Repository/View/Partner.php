<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Partner extends \App\Models\Partner implements View
{
    protected $table = 'partners';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() :
            static::query()->where('name', 'like', "%$query%")
                ->orWhere('sign_name', 'like', "%$query%")
                ->orWhere('phone', 'like', "%$query%")
                ->orWhere('address', 'like', "%$query%");
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
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Nama CV', 'sort' => 'name'],
            ['label' => 'Contact Person', 'sort' => 'name',],
            ['label' => 'Informasi Bank', 'sort' => 'name',],
            ['label' => 'Status','sort' => 'status',],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null,$params=[]): array
    {
        $bank = "";
        foreach ($data->partnerAccounts as $account) {
            $bank .= "<div class='bg-blue-200 p-2 mb-1 text-xs'><div class='float-right'><i class='ti ti-copy' onclick='navigator.clipboard.writeText(`$account->account_number`);alert(`Rekening berhasil di copy`)'></i></div><div>$account->bank_name <span class='font-bold'>$account->account_number</span></div><div>A/N<span class='font-bold'> $account->account_name</span></div></div>";
        }

        $linkEdit = route('admin.partner.edit', $data->id);
        $buttonEdit = "<a href='$linkEdit' class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                       </a>";
        $linkShow = route('admin.partner.show', $data->id);
        $buttonShow = "<a href='$linkShow' class='p-2 bg-green-100 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-green-900' data-icon='lsicon:view-filled'></span>
                       </a>";
        return [
            ['type' => 'index'],
            ['type' => 'raw_html', 'data' => "<div class='text-md font-bold'>$data->name</div><div class='text-xs'>$data->pic</div>"],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xs'><b>No HP/WA</b> : $data->phone</div>
            <div class='text-xs'><b>Alamat</b> : <br> $data->address</div>
            "],
            ['type' => 'raw_html', 'data' => $bank],
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
