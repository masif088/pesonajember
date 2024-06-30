<?php

namespace App\Repository\View;

use App\Models\TransactionList;
use App\Repository\View;
use Illuminate\Database\Eloquent\Builder;

class ProductionSample extends TransactionList implements View
{
    protected $table = 'transaction_lists';

    public static function tableSearch($params = null): Builder
    {
        return static::query()->whereHas('transactionStatus', function ($q) {
            $q->where('transaction_status_type_id', '=', 5);
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
//        ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
//            ['label' => 'Nama Customer'],
//            ['label' => 'Upload Mockup', 'text-align' => 'center'],
//            ['label' => 'Proses', 'text-align' => 'center'],
//            ['label' => 'Status', 'text-align' => 'center'],
//            ['label' => 'Ubah Progress', 'text-align' => 'center'],
//            ['label' => 'Tindakan', 'text-align' => 'center'],
        return [
            ['label' => 'No Pesanan', 'sort' => 'id', 'text-align' => 'center'],
            ['label' => 'Nama Customer',],
            ['label' => 'Sample',],
            ['label' => 'Status', 'text-align' => 'center'],
            ['label' => 'Proses',],
            ['label' => 'PIC',],
            ['label' => 'Tindakan',],
        ];
    }

    public static function tableData($data = null): array
    {

        $pic = '';
        $status = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();
        if (auth()->user()->hasPermissionTo('tambah-pic', 'sanctum')) {
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


        $progress = '';
        $download = '';
//        $d = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'no resi')->first();
        $d = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'status')->first();
        $d2 = $data->transactionStatus->transactionStatusAttachments->where('key', '=', 'no resi')->first();
        $process = 'Sample telah diajukan';
        if ($d2 != null) {
            $process = 'Sample telah dikirim';
        }
        if ($d == null) {
            $tag = 'Belum Input';
            $link = route('transaction.shipper-edit', $data->id);

            $process = "<div class='flex gap-1 flex-wrap'>
                            <a href='$link' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Input Resi</a>
                            <a href='#' wire:click='submitApproval($data->id)' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Ajukan persetujuan gambar</a>
                            </div>";
        } else {
            $tag = $d->value;
            $progress = "<select wire:change='changeMockupStatus($d->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'><option></option><option value='Disetujui'>Disetujui</option><option value='Revisi'>Revisi</option></select>";
        }

        $class = 'px-2 py-1 rounded-lg';
        if ($tag == "Revisi") {
            $link = route('transaction.shipper-edit', $data->id);
            $link2 = route('transaction.sample-site.image', $data->id);
            $class .= " bg-red-200 text-red-600 ";
            $process = "<div class='flex gap-3 flex-wrap'>
<a href='$link' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Input Resi</a>
<a href='$link2' class='px-2 py-1 rounded-lg bg-wishka-200 text-wishka-400 text-nowrap'>Ajukan persetujuan gambar</a>
</div>
";
        }
        if ($tag == "Disetujui") {
            $process = 'Telah disetujui';
            $class .= " bg-wishka-200 text-wishka-400";
            $progress = "
<select wire:change='changeProduction($data->id,event.target.value)' class='bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white'>
<option></option>
<option value='3'>Mockup</option>
<option value='4'>Pola</option>
<option value='5'>Sampel</option>
<option value='6'>Potong</option>
<option value='7'>Print</option>
<option value='8'>Pasang Label</option>
<option value='9'>Jahit</option>
<option value='10'>Quality Control</option>
<option value='11'>Packing</option>
<option value='12'>Menunggu Pembayaran</option>
</select>";
        }


        $link4 = route('finance.transaction.payment.detail', $data->transaction->id);


        $link6 = route('transaction.image-gallery', $data->id);
        $link5 = route('transaction.image-edit', $data->id);

        return [
//            ['type' => 'string', 'data' => $data->created_at->format('d/m/Y')],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $data->transaction->uid . '<br>' . $data->uid],
            ['type' => 'raw_html', 'data' => $data->transaction->customer->name . " <br> <span class='text-sm'>" . $data->transaction->customer->email . '</span>'],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $process],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "<div class='$class'>$tag</div>"],

            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $progress],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => $pic],
            ['type' => 'raw_html', 'text-align' => 'center', 'data' => "
            <div class='text-xl flex gap-1'>
            <a href='$link4' target='_blank' class='py-1 px-2 bg-primary text-white rounded-lg'><i class='ti ti-eye'></i></a>
            $download

            <a href='$link5' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'><i class='ti ti-photo-up'></i></a>
            <a href='$link6' class='py-1 px-2 bg-wishka-600 text-white rounded-lg'><i class='ti ti-album'></i></a>



            </div>"],
        ];
    }
}
