<?php

namespace App\Repository\View;

use App\Models\TransactionList;
use App\Models\TransactionStatus;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionMockup extends Transaction implements View
{
    protected $table = 'transactions';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];

        return empty($query) ? static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 3);
        }) : static::query();
    }

    public static function tableView(): array
    {
        return [
            'searchable' => false,
        ];
    }

    public static function tableField(): array
    {
        return [
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],

            ['label' => 'Nama Customer'],
            ['label' => 'Upload Mockup', 'text-align' => 'center'],
//            ['label' => 'Proses', 'text-align' => 'center'],
            ['label' => 'Status', 'text-align' => 'center'],
            ['label' => 'Ubah status', 'text-align' => 'center'],
            ['label' => 'Tindakan', 'text-align' => 'center'],
        ];
    }

    public static function tableData($data = null): array
    {

//        $p2 = '';
        $d = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'status')->first();
        $production ="<a wire:click='changeTransaction($data->id,14)' href='#' class='py-1 px-2 bg-success text-white rounded-lg'><i class='ti ti-check'></i></a>";

        $class = 'px-2 py-1 rounded-lg';
        $process = 'Telah di upload';
        $link = route('transaction.mockup-site-edit', $data->id);
        $link3 = route('finance.transaction.payment.detail', $data  ->id);

        $edit = "<a href='$link' target='_blank' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-edit'></i></a>";
        $eye = "<a href='$link3' target='_blank' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>";



        $download = '';

        $progress = '';
        if ($d != null) {
//            $p2 = $d2->value;
            $progress = "<select wire:change='changeProduction($data->id,event.target.value)' wire:model.live='cpLive' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'>
<option></option><option value='Disetujui'>Disetujui</option><option value='Revisi'>Revisi</option></select>";
            $link2 = route('transaction.mockup-site-download', $data->id);
            $download = "<a href='$link2' target='_blank' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-download'></i></a>";



            $tag = $d->value;
            if ($tag == 'Revisi') {
                $class .= ' bg-red-200 text-red-600 ';
                $link = route('transaction.mockup-site-edit', $data->id);
                $process = "<a href='$link' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Upload file</a>";
            } elseif ($tag == 'Disetujui') {
                $class .= ' bg-wishka-200 text-wishka-400';
                $progress = "";
            }
        } else {
            $tag = 'Belum Upload Mockup';
            $process = "<a href='$link' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Upload file</a>";
        }



        return [
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $process],
//            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $p2],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<div class='$class'>$tag</div>"],

            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $progress],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "
            <div class='text-xl flex gap-1'>
            $edit $download $eye $production
            </div>
            "],
        ];
    }
}
