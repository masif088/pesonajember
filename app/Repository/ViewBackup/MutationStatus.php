<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class MutationStatus extends \App\Models\MaterialMutationStatus implements View
{
    protected $table='material_mutation_statuses';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query() : static::query()->where('title', 'like', "%$query%");
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {

//        'title', 'note', 'operation'
        return [
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Judul', 'sort' => 'title'],
            ['label' => 'Operasi', 'sort' => 'operation'],
            ['label' => 'Catatan', 'sort' => 'note'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $status = [
            '1' => 'Penambahan',
            '-1' => 'Pengurangan',
            '0' => 'Tidak melakukan perubahan',
        ];
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => $status[$data->operation]],
            ['type' => 'string', 'data' => $data->note],
            ['type' => 'string', 'data' => ''],
        ];
    }
}
