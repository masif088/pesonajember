<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class NewOrder extends \App\Models\User implements View
{
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
        return [
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Name', 'sort' => 'name'],
            ['label' => 'Email', 'sort' => 'email'],
            ['label' => 'Role', 'sort' => 'role'],
            ['label' => 'Aksi'],
        ];
    }

    public static function tableData($data = null): array
    {
        if ($data->role == 1) {
            $role = 'Super Admin';
        } elseif ($data->role == 2) {
            $role = 'Pegawai';
        } else {
            $role = 'Pengguna';
        }
        //        $action = [];
        //        if ($data->role==3 or auth()->user()->role==1){
        //            $action[]=['title' => 'Edit', 'icon' => 'fa fa-eye', 'bg'=>"blue", 'link' => route('admin.users.edit',$data->id)];
        //            $action[]=['title' => 'Hapus', 'icon' => 'fa fa-trash', 'bg'=>"red", 'link' => route('admin.users.non-active',$data->id)];
        //        }

        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->name],
            ['type' => 'string', 'data' => $data->email],
            ['type' => 'string', 'data' => $role],
        ];
    }
}
