<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Customer extends \App\Models\Customer implements View
{
    protected $table = 'customers';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() :
            static::query()->where('name', 'like', "%$query%")
                ->orWhere('company_name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('phone', 'like', "%$query%")
                ->orWhere('note', 'like', "%$query%");
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
            ['label' => 'Konsumen', 'sort' => 'name'],
            ['label' => 'Contact Person', 'sort' => 'name',],
//            ['label' => 'Informasi Bank', 'sort' => 'name',],
//            ['label' => 'Status','sort' => 'status',],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {

        $linkEdit = route('admin.customer.edit', $data->id);
        $buttonEdit = "<a href='$linkEdit' class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                       </a>";
        $linkShow = route('admin.customer.show', $data->id);
        $buttonShow = "<a href='$linkShow' class='p-2 bg-green-100 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-green-900' data-icon='lsicon:view-filled'></span>
                       </a>";
        return [
            ['type' => 'index'],
            ['type' => 'raw_html', 'data' => "<div class='text-md font-bold'>$data->company_name</div><div class='text-xs'>$data->name</div>"],
            ['type' => 'raw_html', 'data' => "
                <div class='text-xs'><b>No HP/WA</b> : $data->phone</div>
                <div class='text-xs'><b>Email</b> : $data->email</div>
            "],
            ['type' => 'raw_html', 'data' =>
                "<div class='text-xl flex gap-1'><br>
                    $buttonEdit
                    $buttonShow
                </div>"
            ],

        ];
    }
}
