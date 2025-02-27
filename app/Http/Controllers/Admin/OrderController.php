<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderMockup;
use App\Models\OrderProductOut;
use App\Models\Partner;
use App\Models\TransactionType;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    public array $property = [
        'main-title'=>'Order Baru',
        'index'=>'admin.order.index',
    ];
    public string $name ='admin.order.';
    public function index()
    {
        return view($this->name.'index',['property' => $this->property]);
    }
    public function orderRecapitulation()
    {
        $this->property['title'] = "Rekap Order" ; ;
        return view($this->name.'order-recapitulation',['property' => $this->property]);
    }
    public function orderCancel()
    {
        $this->property['title'] = "Rekap Order Cancel" ; ;
        return view($this->name.'order-cancel',['property' => $this->property]);
    }
    public function orderDone()
    {
        $this->property['title'] = "Rekap Order Selesai" ; ;
        return view($this->name.'order-done',['property' => $this->property]);
    }


    public function createECatalog($id)
    {
        $type = TransactionType::find($id);
        $this->property['title'] = 'Tambah order '.$type->title;
        return view($this->name.'create',['property' => $this->property,'id'=>$id]);
    }
    public function createECatalogOrder($id)
    {
        $order = Order::find($id);
        $this->property['title'] = "Input Order {$order->transactionType->title} - {$order->order_number}" ; ;
        return view($this->name.'createInputOrder',['property' => $this->property,'id'=>$id]);
    }
    public function createECatalogPreview($id)
    {
        $order = Order::find($id);
        $this->property['title'] = "Preview Order {$order->transactionType->title} - {$order->order_number}" ; ;
        return view($this->name.'createPreviewOrder',['property' => $this->property,'id'=>$id]);
    }

    public function edit(Order $id)
    {
        $this->property['title'] = "Ubah data order - $id->order_number";
        return view($this->name.'edit',['property' => $this->property,'data'=>$id]);
    }
    public function show(Order $id)
    {
        $this->property['title'] = 'Rekap Transaksi '.$id->transactionType->title;
        return view($this->name.'show',['property' => $this->property,'data'=>$id]);
    }
    public function hpp($id)
    {
        $order = Order::find($id);
        $this->property['title'] = "Input HPP {$order->transactionType->title} - {$order->order_number}" ; ;
        return view($this->name.'hpp',['property' => $this->property,'id'=>$id]);
    }
    public function sharing($id)
    {
        $order = Order::find($id);
        $this->property['title'] = "Sharing {$order->transactionType->title} - {$order->order_number}" ; ;
        return view($this->name.'sharing',['property' => $this->property,'id'=>$id]);
    }
    public function sharingPercentage($id)
    {
        $order = Order::find($id);
        $this->property['title'] = "Sharing Percentage {$order->transactionType->title} - {$order->order_number}" ; ;
        return view($this->name.'sharing-percentage',['property' => $this->property,'id'=>$id]);
    }
    public function taxEdit($id)
    {
        $order = Order::find($id);
        $this->property['title'] = "Tax Edit {$order->transactionType->title} - {$order->order_number}" ; ;
        return view($this->name.'tax-edit',['property' => $this->property,'id'=>$id]);
    }
    public function orderStatus($id)
    {
        $order = Order::find($id);
        $this->property['title'] = "Selesaikan transaksi {$order->transactionType->title} - {$order->order_number}" ; ;
        return view($this->name.'complete-transaction',['property' => $this->property,'id'=>$id]);
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
            $numberFormat = $this->getNumberFormat($count, $numberFormat, $now);
            $orderOut->update([
                'reference_waybill' => $numberFormat,
                'date_waybill' => $now->format('Y-m-d'),
            ]);
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.waybill', compact('id', 'orderId', 'outId'));
        return $pdf->stream();
    }

    public function proofOfCashCreate($id){
        $order = Order::find($id);
//        $partner = Partner::find($id);
        $this->property['title'] = 'Tambah kwitansi - ' . $order->order_number;
        return view('admin.order.proof-of-cash.create',['property' => $this->property,'id'=>$id]);
    }
    public function proofOfCashEdit($id,$poc){
        $order = Order::find($id);
        $this->property['title'] = 'Tambah kwitansi - ' . $order->order_number;
        return view('admin.order.proof-of-cash.edit',['property' => $this->property,'id'=>$id,'poc'=>$poc]);
    }
    public function downloadProofOfCash($id, $poc)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.kwitansi',compact('poc','id'));
        return $pdf->stream();
    }
    public function createMockup($id){
        $this->property['title'] = 'Tambah Mockup' ;
        return view($this->name.'mockup',['property' => $this->property,'id'=>$id]);
    }
    public function downloadMockup($id,$mockup){

        $m =OrderMockup::find($mockup);
        return response()->download('storage/'.$m->mockup_file);
    }
}
