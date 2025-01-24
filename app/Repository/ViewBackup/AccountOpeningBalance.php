<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Illuminate\Database\Eloquent\Builder;

class AccountOpeningBalance extends \App\Models\AccountOpeningBalance implements View
{
    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query() : static::query()
            ->whereHas('accountName', function ($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                    ->orWhere('code', 'like', "%$query%")
                    ->orWhere('level', 'like', "%$query%");
            })
            ->orWhere('month', 'like', "%$query%")
            ->orWhere('year', 'like', "%$query%");
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
            ['label' => 'Nama Account'],
            ['label' => 'Periode'],
            ['label' => 'Jumlah'],
            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $link = route('finance.account-opening-balance.edit', $data->id);

        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->accountName->code . ' - ' . $data->accountName->title],
            ['type' => 'string', 'data' => month_name($data->month) . ' ' . $data->year],
            ['type' => 'string', 'data' => 'Rp. ' . thousand_format($data->opening_balances)],
            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
                <a href='$link' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-pencil'></i></a>
                <a href='#' wire:click='deleteItem($data->id)' class='py-1 px-2 bg-error text-white rounded-lg'><i class='ti ti-trash'></i></a>
            </div>
            "],
        ];
    }
}
