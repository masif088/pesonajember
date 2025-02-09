<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProofOfCash;
use App\Models\Partner;
use Illuminate\Http\Request;

class ProofOfCashController extends Controller
{
    public array $property = [
        'main-title'=>'Kwitansi',
        'index'=>'admin.proof-of-cash.index',
    ];
    public string $name ='admin.proof-of-cash.';
    public function index($id)
    {
        return view($this->name."index",['property' => $this->property,'id' => $id]);
    }
    public function create($id, $orderId)
    {
        $this->property['title'] = 'Tambah kwitansi';
        return view($this->name.'create',['property' => $this->property,'id' => $id,'orderId' => $orderId]);
    }

    public function edit($id, $orderId,$poc)
    {
        $this->property['title'] = 'Ubah data kwitansi';
        return view($this->name.'edit',['property' => $this->property,'data'=>$id,'id' => $id,'orderId' => $orderId,'poc' => $poc]);
    }


    public function show($id, $orderId)
    {
        $partner = Partner::find($id);
        $this->property['main-title'] .= " $partner->name";
        $order = Order::find($orderId);
        return view($this->name . 'show', ['property' => $this->property, 'id' => $id, 'partner' => $partner, 'order' => $order]);
    }

}
