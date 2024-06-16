<?php

namespace App\Repository\View;

use App\Models\CompanyAssetDecreaseValue;
use App\Repository\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CompanyAsset extends \App\Models\CompanyAsset implements View
{
    protected $table = 'company_assets';

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
        //        'bank_name','account_number', 'account_in_name', 'note', 'status_id'
        return [
            ['label' => '#', 'sort' => 'id', 'width' => '7%'],
            ['label' => 'Krteria Asset'],
            ['label' => 'Jenis Asset'],

            ['label' => 'Masa Manfaat'],
            ['label' => 'Tahun Perolehan'],
            ['label' => 'Nilai Perolehan'],
            ['label' => 'Nilai Sekarang'],
            ['label' => 'Penyusutan'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $linkShow = route('company-asset.show', $data->id);
        $linkEdit = route('company-asset.edit', $data->id);

        $now = Carbon::now();
        $cadv = CompanyAssetDecreaseValue::where('company_asset_id','=',$data->id)->where('year',$now->year)->where('month',$now->month)->first();
        $last_shrinkage="";
        if ($cadv==null){
            $last_shrinkage= "<button class='py-1 px-2 bg-warning text-white rounded-lg text-nowrap' wire:click='shrinkageNow($data->id)'><i class='ti ti-arrows-minimize'></i> </button>";
        }


        //        $linkEdit  = route('company-asset.edit',$data->id);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->companyAssetCategory->title],
            ['type' => 'string', 'data' => "$data->title ($data->unit)"],
            ['type' => 'string', 'data' => $data->useful_life],
            ['type' => 'string', 'data' => month_name($data->month_acquisition).'/'.$data->year_acquisition],
            ['type' => 'raw_html', 'data' => "<font style='text-wrap: nowrap'>Rp. ".thousand_format($data->value).'</font>'],
            ['type' => 'raw_html', 'data' => "<font style='text-wrap: nowrap'>Rp. ".thousand_format($data->value_now).'</font>'],
            ['type' => 'raw_html', 'data' => "<font style='text-wrap: nowrap'>Rp. ".thousand_format($data->last_shrinkage).'</font>'],

            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
            $last_shrinkage
                <a href='$linkShow' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>
                <a href='$linkEdit' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
