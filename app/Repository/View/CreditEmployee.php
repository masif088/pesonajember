<?php

namespace App\Repository\View;

use App\Repository\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CreditEmployee extends \App\Models\CooperativeCreditEmployee implements View
{
    protected $table='cooperative_credit_employees';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $month = $params['param1'];
        $year = $params['param2'];

        return empty($query) ? static::query()
//            ->whereMonth('date_transaction', '=', $month)
//            ->whereYear('date_transaction', '=', $year)
            :
            static::query()
//                ->whereMonth('date_transaction', '=', $month)
//                ->whereYear('date_transaction', '=', $year)
                ->orderBy('date_transaction')->where(function (Builder $query) {
                    $query->where('title', 'like', "%$query%");
                });
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {
//        'user_id', 'credit'
        //        'bank_name','account_number', 'account_in_name', 'note', 'status_id'
        return [
            ['label' => '#', 'width' => '7%'],
            ['label' => 'Nama'],
            ['label' => 'Jumlah Hutang'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $link = route('cooperative.credit-employee-detail', $data->user_id);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->user->name],
            ['type' => 'string', 'data' =>'Rp. '.thousand_format(abs($data->credit))],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$link' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-eye'></i></a>
            </div>
            "],
        ];
    }
}
