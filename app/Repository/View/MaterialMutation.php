<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class MaterialMutation extends \App\Models\MaterialMutation implements View
{
    protected $table = 'material_mutations';

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
            ['label' => 'Tanggal', 'sort' => 'created_at'],
            ['label' => 'Keterangan', 'sort' => 'reference'],
            ['label' => 'Perubahan Stock', 'sort' => 'amount','text-align'=>'center'],
            ['label' => 'Stock Terkini', 'sort' => 'stock','text-align'=>'center'],
        ];
    }

    public static function tableData($data = null): array
    {

        $material= \App\Models\Material::find($data->material_id);
        $linkStock = route('material.material-stock', $data->id);
        try {
            return [
                ['type' => 'string' ,'data' => $data->created_at],
                ['type' => 'raw_html', 'data' => $data->reference ."<br> <span class='text-xs'>$data->note</span>"],
                ['type' => 'string','text-align'=>'center', 'data' => ($data->amount*$data->materialMutationStatus->operation).$material->unit],
                ['type' => 'string','text-align'=>'center', 'data' => round($data->stock,2).$material->unit],
            ];
        }catch (\Exception $q){

//            dd(data$material);
        }
    }
}
