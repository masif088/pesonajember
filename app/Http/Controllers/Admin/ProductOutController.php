<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProductOut;
use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ProductOutController extends Controller
{
    public array $property = [
        'main-title' => 'Barang keluar & Surat Jalan',
        'index' => 'admin.product-out.index',
    ];
    public string $name = 'admin.product-out.';

    public function index($id)
    {
        $partner = Partner::find($id);
        $this->property['main-title'] .= " $partner->name";
        return view($this->name . 'index', ['property' => $this->property, 'id' => $id, 'partner' => $partner]);
    }

    public function show($id, $orderId)
    {
        $partner = Partner::find($id);
//        dd($partner);
        $this->property['main-title'] .= " $partner->name";
        $order = Order::find($orderId);
        return view($this->name . 'show', ['property' => $this->property, 'id' => $id, 'partner' => $partner, 'order' => $order]);
    }

    public function create($id, $orderId)
    {
        $partner = Partner::find($id);
        $this->property['main-title'] .= " $partner->name";
        $this->property['title'] = "Tambah Barang Keluar & Surat Jalan";
        return view($this->name . 'create', ['property' => $this->property, 'id' => $id, 'orderId' => $orderId]);
    }

    public function edit($id, $orderId, $outId)
    {
        $partner = Partner::find($id);
        $this->property['main-title'] .= " $partner->name";
        $this->property['title'] = "Ubah Bukti Barang Keluar & Surat Jalan";
        return view($this->name . 'edit', ['property' => $this->property, 'id' => $id, 'orderId' => $orderId, 'outId' => $outId]);
    }

    public function upload($id, $orderId, $outId)
    {
        $partner = Partner::find($id);
        $this->property['main-title'] .= " $partner->name";
        $this->property['title'] = "Upload Bukti Barang Keluar & Surat Jalan";
        return view($this->name . 'upload', ['property' => $this->property, 'id' => $id, 'orderId' => $orderId, 'outId' => $outId]);
    }

    public function downloadWaybill($id, $orderId, $outId)
    {
        $orderOut = OrderProductOut::find($outId);
        if ($orderOut->reference_waybill == null) {
            $partner = Partner::find($id);
            $numberFormat = $partner->format_number_driver;
            $now = Carbon::now();
            $count = OrderProductOut::where('partner_id', $partner->id)
                    ->where('date_waybill', '<>', null)
                    ->where('proof_of_waybill', '<>', null)
                    ->where('date_waybill', $now->format('Y-m-d'))
                    ->count() + 1;
            $numberFormat = getNumberFormat($count, $numberFormat, $now);
            $orderOut->update([
                'reference_waybill' => $numberFormat,
                'date_waybill' => $now->format('Y-m-d'),
            ]);
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.waybill', compact('id', 'orderId', 'outId'));
        return $pdf->stream();
    }

    public function downloadProductOut($id, $orderId, $outId)
    {
        $orderOut = OrderProductOut::find($outId);
        if ($orderOut->reference_waybill == null) {
            $partner = Partner::find($id);
            $numberFormat = $partner->format_number_driver;
            $now = Carbon::now();
            $count = OrderProductOut::where('partner_id', $partner->id)
                    ->where('date_product_out', '<>', null)
                    ->where('proof_of_product_out', '<>', null)
                    ->where('date_product_out', $now->format('Y-m-d'))
                    ->count() + 1;
            $numberFormat = getNumberFormat($count, $numberFormat, $now);
            $orderOut->update([
                'reference_product_out' => $numberFormat,
                'date_product_out' => $now->format('Y-m-d'),
            ]);
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.product-out', compact('id', 'orderId', 'outId'));
        return $pdf->stream();
    }


}
