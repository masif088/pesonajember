<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\OrderProductOut;
use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class InvoiceController extends Controller
{

    public array $property = [
        'main-title' => 'Invoice',
        'index' => 'admin.invoice.index',
    ];
    public string $name = 'admin.invoice.';

    public function index($id)
    {
        return view($this->name . "index", ['property' => $this->property, 'id' => $id]);
    }

    public function create($id, $orderId)
    {
        $this->property['title'] = 'Tambah Invoice';
        return view($this->name . 'create', ['property' => $this->property, 'id' => $id, 'orderId' => $orderId]);
    }

    public function edit($id, $orderId, $poc)
    {
        $this->property['title'] = 'Ubah data Invoice';
        return view($this->name . 'edit', ['property' => $this->property, 'data' => $id, 'id' => $id, 'orderId' => $orderId, 'poc' => $poc]);
    }


    public function show($id, $orderId)
    {
        $partner = Partner::find($id);
        $this->property['main-title'] .= " $partner->name";
        $order = Order::find($orderId);
        return view($this->name . 'show', ['property' => $this->property, 'id' => $id, 'partner' => $partner, 'order' => $order]);
    }

    public function download($id,$invoiceId)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', compact('id','invoiceId'));
        return $pdf->stream();
    }
}
