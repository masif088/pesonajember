<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Partner;
use App\Models\TransactionType;

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
}
