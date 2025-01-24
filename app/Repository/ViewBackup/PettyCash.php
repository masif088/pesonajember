<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
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
        $totalDebit = PettyCash::where('date_transaction', '<=', $data->date_transaction)->sum('debit');
        $totalCredit = PettyCash::where('date_transaction', '<=', $data->date_transaction)->sum('credit');

        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->date_transaction],
            ['type' => 'string', 'data' => $data->title],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->debit)],
            ['type' => 'string', 'data' => 'Rp. '.thousand_format($data->credit)],
            ['type' => 'string', 'data' => 'Rp. ' . thousand_format($totalDebit - $totalCredit)],

            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$link' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
