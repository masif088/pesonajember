<?php

namespace App\Repository\View;

use App\Repository\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class BigCash extends \App\Models\BigCash implements View
{
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $month = $params['param1'];
        $year = $params['param2'];
        return empty($query) ? static::query()->whereMonth('date_transaction','=',$month)->whereYear('date_transaction','=',$year)->orderBy('date_transaction') : static::query();
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
            ['label' => 'Saldo'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $link = route('finance.big-cash.edit', $data->id);
        $totalDebit = BigCash::where('date_transaction','<=',$data->date_transaction)->sum('debit');
        $totalCredit = BigCash::where('date_transaction','<=',$data->date_transaction)->sum('credit');
//        dd($totalDebit);
//        dd($totalDebit);
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => Carbon::parse($data->date_transaction)->format('Y-m-d')],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->debit)],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->credit)],
            ['type' => 'string', 'data' => $totalDebit-$totalCredit],

            ['type' => 'raw_html', 'data' => "
            <a class='btn bg-wishka-400' href='$link'><i class='ti ti-pencil'></i></a>
            <a class='btn bg-wishka-400' href='$link'><i class='ti ti-pencil'></i></a>
            "],
        ];
    }
}
