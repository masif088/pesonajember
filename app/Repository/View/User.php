<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class User extends \App\Models\User implements View
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
        return [
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Name', 'sort' => 'name'],
            ['label' => 'Email', 'sort' => 'email'],
            ['label' => 'Role', 'sort' => 'role'],
            ['label' => 'Jabatan', 'sort' => 'role'],
            ['label' => 'Aksi'],
        ];
    }

    public static function tableData($data = null, $params = []): array
    {
        $delete = "";
        if ($data->role == 1) {
            $role = 'Super Admin';
        } else if ($data->role == 2) {
            $role = 'Admin';
            $delete = "<a href='#' wire:click='deleteItem($data->id)' class='p-2 bg-red-200 hover:bg-red-100 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-red-900' data-icon='mingcute:delete-fill'></span>
                       </a>";
        } else {
            $role = 'Pegawai';
            $delete = "<a href='#' wire:click='deleteItem($data->id)' class='p-2 bg-red-200 hover:bg-red-100 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-red-900' data-icon='mingcute:delete-fill'></span>
                       </a>";
        }

        $linkEdit = route('admin.employee.edit', $data->id);
        $imgEdit = asset('assets/icons/ic_edit.svg');
        $buttonEdit = "<a href='$linkEdit' class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                            <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                       </a>";

//        $linkEdit = route('admin.employee.edit',$data->id);
        return [
            ['type' => 'string', 'data' => $data->id],
            ['type' => 'string', 'data' => $data->name],
            ['type' => 'string', 'data' => $data->email],
            ['type' => 'string', 'data' => $role],
            ['type' => 'string', 'data' => $data->position],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                $buttonEdit
                $delete

            </div>
            "],
        ];
    }
}
