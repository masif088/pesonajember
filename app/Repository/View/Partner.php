<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Partner extends \App\Models\Partner implements View
{
    protected $table='partners';
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
//        'partner_category_id', 'name', 'phone', 'email', 'address', 'note'
        return [
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Kategori', 'sort' => 'partner_category_id'],
            ['label' => 'Nama', 'sort' => 'name'],
            ['label' => 'No HP', 'sort' => 'phone'],
            ['label' => 'Email', 'sort' => 'email'],
            ['label' => 'Alamat', 'sort' => 'address'],
            ['label' => 'Catatan', 'sort' => 'note'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->partnerCategory->title],
            ['type' => 'string', 'data' => $data->name],
            ['type' => 'string', 'data' => $data->phone],
            ['type' => 'string', 'data' => $data->email],
            ['type' => 'string', 'data' => $data->address],
            ['type' => 'string', 'data' => $data->note],
            ['type' => 'string', 'data' => ''],
        ];
    }
}
