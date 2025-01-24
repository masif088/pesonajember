<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class Product extends \App\Models\Product implements View
{
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query() :
            static::query()->where('title', 'like', "%$query%");
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
            ['label' => 'Kode', 'sort' => 'code'],
            ['label' => 'Nama produk', 'sort' => 'title'],
            ['label' => 'Harga', 'sort' => 'email'],
            ['label' => 'Stock', 'text-align' => 'center'],
            ['label' => 'Aksi'],
        ];
    }

    public static function tableData($data = null): array
    {
        $cost = 0;
        foreach ($data->productAdditionalCosts as $c) {
            $cost += $c->amount * $c->price;
        }
        foreach ($data->productMaterials as $c) {
            $cost += ($c->material->value / $c->material->stock) * $c->amount * $c->size;
        }
        $margin = thousand_format($data->price - $cost);
        if ($cost!=0){
            $marginPercentage = thousand_format((($data->price - $cost) / $cost) * 100);
        }else{
            $marginPercentage = '-';
        }

        $cost = thousand_format($cost);
        $price = thousand_format($data->price);
        if ($data->custom_status == 1) {
            $stock = 'Custom';
        } else {
            $stock = thousand_format($data->stock) . 'pcs';
        }
        $link = route('production.show',$data->id);
        $link2 = route('production.edit',$data->id);

        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->code],
            ['type' => 'raw_html', 'data' => "
            <div>
            $data->title <br>
            <span class='text-xs'>$data->size</span>
            </div>
            "],
            ['type' => 'raw_html', 'data' => "
                <div>
                    Harga jual : Rp. $price <br>
                    HPP : Rp. $cost <br>
                    <b>Margin : Rp. $margin ($marginPercentage%)<br></b>
                </div>",
            ],

            ['type' => 'string', 'text-align' => 'center', 'data' => $stock],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$link' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>
                <a href='$link2' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
