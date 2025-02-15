<?php

namespace App\Repository\View;

use App\Repository\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Salary extends \App\Models\Salary implements View
{
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() :
            static::query();
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {
        //        'form.user_id' => 'required',
        //            'form.salary' => 'decimal:2',
        //            'form.bonus' => 'decimal:2',
        //            'form.allowance' => 'decimal:2',
        //            'form.transportation' => 'decimal:2',
        //            'form.note' => 'nullable',
        //            'form.reference' => 'nullable',
        return [
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Name', 'sort' => 'user_id'],
            ['label' => 'Dikeluarkan pada'],
            ['label' => 'Total Gaji'],
            ['label' => 'Aksi'],
        ];
    }

    public static function tableData($data = null,$params=[]): array
    {


        $linkEdit = route('admin.salary.edit', $data->id);
        $buttonEdit = "<a href='$linkEdit' class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                       </a>";
        $delete = "<a href='#' wire:click='deleteItem($data->id)' class='p-2 bg-red-200 hover:bg-red-100 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-red-900' data-icon='mingcute:delete-fill'></span>
                       </a>";

        $link  = route('admin.salary.show',[$data->id]);
        $salary =  "<a href='$link'
                                   target='_blank'
                                   class='bg-pink-100 hover:bg-pink-200 rounded p-2 text-pink-900 '>
                                    <span class='iconify text-pink-900'
                                          data-icon='material-symbols:download'></span>

                                </a>";


        $totalSalary = $data->salary+$data->bonus+$data->allowance+$data->transportation;
//        dd($data);

        return [
            ['type' => 'string', 'data' => $data->id],
            ['type' => 'string', 'data' => $data->user->name],
            ['type' => 'string', 'data' => Carbon::parse($data->create_at)->format('d-m-Y')],
            ['type' => 'string', 'data' => "Rp. ".thousand_format($totalSalary)],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                $buttonEdit
                $delete
                $salary

            </div>
            "],
        ];
    }
}
