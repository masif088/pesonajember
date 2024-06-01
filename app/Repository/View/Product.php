<?php

namespace App\Repository\View;

use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class Product extends \App\Models\Product implements View
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
            ['label' => 'Kode', 'sort' => 'code'],
            ['label' => 'Nama produk', 'sort' => 'title'],
            ['label' => 'Harga', 'sort' => 'email'],
            ['label' => 'Proses'],
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
        $marginPercentage = thousand_format((($data->price - $cost) / $cost) * 100);
        $cost = thousand_format($cost);
        $price = thousand_format($data->price);
        if ($data->custom_status == 1) {
            $stock = 'Custom';
        } else {
            $stock = thousand_format($data->stock) . 'pcs';
        }

        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->code],
            ['type' => 'raw_html', 'data' => "
            <div>
            $data->title <br>
            <span class='text-xs'>$data->size</span>
            </div>
            "],
            ['type' => 'raw_html', 'data' => "<div>
Harga jual : Rp. $price <br>
HPP : Rp. $cost <br>
<b>Margin : Rp. $margin ($marginPercentage%)<br></b>
</div>",
            ],
            ['type' => 'raw_html', 'data' => '<a href="#" class="btn bg-wishka-200 text-black">Lihat</a>'],
            ['type' => 'string', 'text-align' => 'center', 'data' => $stock],
            ['type' => 'string', 'data' => ''],
        ];
    }
}
