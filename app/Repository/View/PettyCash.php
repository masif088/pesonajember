<?php

namespace App\Repository\View;

use App\Repository\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PettyCash extends \App\Models\PettyCash implements View
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
        $link = route('finance.petty-cash.edit', $data->id);
        $totalDebit = PettyCash::where('date_transaction','<=',Carbon::now());
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->date_transaction],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->debit)],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->credit)],
            ['type' => 'string', 'data' => ''],

            ['type' => 'raw_html', 'data' => "
            <a class='btn bg-wishka-400' href='$link'><i class='ti ti-pencil'></i></a>
            "],
        ];
    }
}
