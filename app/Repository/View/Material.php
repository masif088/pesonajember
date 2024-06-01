<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Material extends \App\Models\Material implements View
{
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->orderBy('status_id') : static::query();
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
            ['label' => 'Kode', 'sort' => 'code'],
            ['label' => 'jenis', 'sort' => 'material_category_id'],
            ['label' => 'Nama', 'sort' => 'title'],
            ['label' => 'Stock', 'sort' => 'stock'],
            ['label' => '∑Harga'],
            ['label' => 'Nilai Material', 'sort' => 'value'],
            ['label' => 'Status', 'text-align' => 'center',],
            ['label' => 'Tindakan', 'text-align' => 'center'],
        ];
    }

    public static function tableData($data = null): array
    {

        $linkStock = route('material.material-stock', $data->id);
        if ($data->status_id == 2) {
            $status = "<div class='bg-black  rounded-lg text-center'>Tidak Aktif</div>";
        } else if ($data->stock == 0) {
            $status = "<div class='bg-error  rounded-lg text-center'>Habis</div>";
        } else if ($data->stock <= $data->minimum_stock) {
            $status = "<div class='bg-warning  rounded-lg text-center'>Menipis</div>";
        } else {
            $status = "<div class='bg-success  rounded-lg text-center'>Tersedia</div>";
        }
        $value = 0;
        if ($data->stock!=0){
            $value = $data->value / $data->stock;
        }


        return [
            ['type' => 'string', 'data' => $data->code],
            ['type' => 'string', 'data' => $data->materialCategory ? $data->materialCategory->title : ''],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => thousand_format($data->stock) . $data->unit],
            ['type' => 'string', 'data' => 'Rp. ' . thousand_format($value)],
            ['type' => 'string', 'data' => 'Rp. ' . thousand_format($data->value)],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $status],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "
            <a href='$linkStock'><i class='ti ti-box text-2xl text-wishka-500 mr-2'></i></a>
            <i class='ti ti-pencil text-2xl text-wishka-500'></i>
            "],
        ];
    }
}
