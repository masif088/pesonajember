<?php

namespace App\Repository\View;

use App\Models\Transaction;
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
            ['label' => 'Proses', 'text-align' => 'center'],
            ['label' => 'Status', 'text-align' => 'center'],
            ['label' => 'Ubah Progress', 'text-align' => 'center'],
            ['label' => 'Tindakan', 'text-align' => 'center'],
        ];
    }

    public static function tableData($data = null): array
    {

        $p2 = '';
        $d = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'status')->first();
        $d2 = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'process')->first();

        $class = 'px-2 py-1 rounded-lg';
        $process = 'Telah disetujui';
        $link = route('transaction.mockup-site-edit', $data->id);
        $link3 = route('finance.transaction.payment.detail', $data->id);
        $edit = '';
        $download = '';
        $eye = '';
        $progress = '';
        if ($d != null) {
            $p2 = $d2->value;
            $progress = "<select wire:change='changeMockupStatus($d->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'><option></option><option value='Disetujui'>Disetujui</option><option value='Revisi'>Revisi</option></select>";
            $link2 = route('transaction.mockup-site-download', $data->id);
//            $download = "<a href='$link2' target='_blank' style='cursor:pointer;' title='Download surat Perintah'><i class='ti ti-download p-1'></i></a>";
            //            <a href='$link4' target='_blank' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>
            $download="<a href='$link2' target='_blank' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-download'></i></a>";
//            $edit = "<a href='$link' style='cursor:pointer;' title='Upload ulang'><i class='ti ti-pencil p-1'></i></a>";
            $edit = "<a href='$link' target='_blank' class='py-1 px-2 bg-secondary text-white rounded-lg'><i class='ti ti-edit'></i></a>";
            $eye = "<a href='$link3' target='_blank' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>";
            $tag = $d->value;
            if ($tag == 'Revisi') {
                $class .= ' bg-red-200 text-red-600 ';
                $link = route('transaction.mockup-site-edit', $data->id);
                $process = "<a href='$link' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Upload Image</a>";
            } elseif ($tag == 'Disetujui') {
                $class .= ' bg-wishka-200 text-wishka-400';
                $progress = "<select wire:change='changeProduction($data->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'><option></option><option value='3'>Mockup</option><option value='4'>Pola</option><option value='5'>Sampel</option><option value='6'>Potong</option><option value='7'>Print</option><option value='8'>Pasang Label</option><option value='9'>Jahit</option><option value='10'>Quality Control</option><option value='11'>Packing</option><option value='12'>Menunggu Pembayaran</option></select>";

            }
//            <a href='$link4' target='_blank' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>
        } else {
            $tag = 'Belum Upload Mockup';

            $process = "<a href='$link' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Upload Image</a>";
        }

        return [
            ['type' => 'string', 'text-align' => 'center', 'data' => $data->uid],
            ['type' => 'raw_html', 'data' => $data->customer->name." <br> <span class='text-sm'>".$data->customer->email.'</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $process],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $p2],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<div class='$class'>$tag</div>"],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $progress],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "
            <div class='text-xl flex gap-1'>
                        $edit
            $download
            $eye
            </div>

            "],
        ];
    }
}
