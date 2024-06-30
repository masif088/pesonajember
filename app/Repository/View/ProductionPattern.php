<?php

namespace App\Repository\View;

use App\Models\TransactionList;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionPattern extends TransactionList implements View
{
    protected $table = 'transaction_lists';

    public static function tableSearch($params = null): Builder
    {
        return static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 4);
        })->whereHas('transaction', function (Builder $q) {
            $q->whereHas('transactionStatus', function (Builder $q2) {
                $q2->where('transaction_status_type_id', 14);
            });
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
        return [
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Nama Customer'],
            ['label' => 'Produk', 'text-align' => 'center'],
            ['label' => 'PIC', 'text-align' => 'center'],
            ['label' => 'Acuan kerja'],
            ['label' => 'Ubah Progress', 'text-align' => 'center'],

            ['label' => 'Tindakan'],
        ];
    }

    public static function tableData($data = null): array
    {
        $mockupButton = 'Mockup tidak ditemukan';
        $mockup = $data->transaction->transactionStatuses->where('transaction_status_type_id', '=', 3)->first();
        if ($mockup != null) {
            $mockup = $mockup->transactionStatusAttachments->where('key', 'pdf mockup')->first();
            if ($mockup != null) {
                $link2 = route('customer.transaction-download-pdf', base64_encode($mockup->value));
                $mockupButton = "<a href='$link2' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Mockup</a>";
            }
        }

        $link3 = route('transaction.mockup-site-download', $data->id);
        $worksheetButton = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Worksheet</a>";


        $process = 'Telah terkirim';

        $edit = '';
        $download = '';
        $progress = "<select wire:change='changeProduction($data->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'><option></option><option value='3'>Mockup</option><option value='4'>Pola</option><option value='5'>Sampel</option><option value='6'>Potong</option><option value='7'>Print</option><option value='8'>Pasang Label</option><option value='9'>Jahit</option><option value='10'>Quality Control</option><option value='11'>Packing</option><option value='12'>Menunggu Pembayaran</option></select>";
        $link3 = route('transaction.pic-edit', $data->id);

        $pic = '';
        $status = null;
        if (auth()->user()->hasPermissionTo('tambah-pic', 'sanctum')) {
            $status = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();
            $link3 = route('transaction.pic-edit', $data->id);
            $pic = "<a href='$link3' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-center text-nowrap'>Input PIC</a>";
        }

        if ($status != null) {
            if ($status->type == 'string') {
                $pic = $status->value;
            }
            if ($status->type != 'string') {
                $pic = new $status->type();
                $pic = $pic->find($status->value)->name;
            }
        }

        $link4 = route('transaction.image-gallery', $data->id);
        $link5 = route('transaction.image-edit', $data->id);

        return [
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $data->transaction->uid.'<br>'.$data->uid],
            ['type' => 'raw_html', 'data' => $data->transaction->customer->name." <br> <span class='text-sm'>".$data->transaction->customer->email.'</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $data->product->title],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $pic],
            ['type' => 'raw_html', 'data' => "<div class='flex gap-1 flex-wrap'>$mockupButton $worksheetButton</div>"],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $progress],

            ['type' => 'raw_html', 'data' => "
            <div class='text-xl flex gap-1'>
            $edit
            $download
            <a href='$link5' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'><i class='ti ti-photo-up'></i></a>
            <a href='$link4' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'><i class='ti ti-album'></i></a>
            </div>
            "],
        ];
    }
}
