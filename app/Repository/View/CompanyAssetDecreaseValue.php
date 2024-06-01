<?php

namespace App\Repository\View;

//use App\Models\CompanyAssetDecreaseValue;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class CompanyAssetDecreaseValue extends \App\Models\CompanyAssetDecreaseValue implements View
{
    protected $table = 'company_asset_decrease_values';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $param1 = $params['param1'];

        return empty($query) ? static::query()->where('company_asset_id', '=', $param1) :
            static::query()->where('company_asset_id', '=', $param1);
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {
        //        'bank_name','account_number', 'account_in_name', 'note', 'status_id'
        return [
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Periode Penyusutan'],
            ['label' => 'Jumlah susut'],
        ];
    }

    public static function tableData($data = null): array
    {
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => month_name($data->month).'/'.$data->year],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->shrinkage)],
        ];
    }
}
