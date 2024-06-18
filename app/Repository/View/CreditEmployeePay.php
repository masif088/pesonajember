<?php

namespace App\Repository\View;

use App\Repository\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CreditEmployeePay extends \App\Models\CooperativeCreditEmployeePay implements View
{
    protected $table = 'cooperative_credit_employee_details';
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $month = $params['param1'];
        $year = $params['param2'];

        return empty($query) ? static::query()->whereHas('cooperativeCreditEmployee',function ($q) use ($month) {
            $q->where('user_id',$month);
        })
//            ->whereMonth('date_transaction', '=', $month)
//            ->whereYear('date_transaction', '=', $year)
            ->orderBy('id') :
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
            'searchable' => false,
        ];
    }

    public static function tableField(): array
    {
        //        'bank_name','account_number', 'account_in_name', 'note', 'status_id'
        return [
            ['label' => '#', 'width' => '7%'],
            ['label' => 'Tanggal'],
            ['label' => 'Uraian'],
            ['label' => 'Debet'],
            ['label' => 'Kredit'],
            ['label' => 'Tindakan'],

        ];
    }

    public static function tableData($data = null): array
    {

        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => Carbon::parse($data->date_transaction)->format('Y-m-d')],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->debit)],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->credit)],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
