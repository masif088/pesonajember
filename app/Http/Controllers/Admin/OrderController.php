<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Partner;

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
    public function createECatalog()
    {
        $this->property['title'] = 'Tambah order E-Catalog';
        return view($this->name.'createECatalog',['property' => $this->property]);
    }
    public function createECatalogOrder($id)
    {
        $this->property['title'] = 'Input Order E-Catalog';
        return view($this->name.'createECatalogOrder',['property' => $this->property,'id'=>$id]);
    }
    public function createECatalogPreview($id)
    {
        $this->property['title'] = 'Preview Order E-Catalog';
        return view($this->name.'createECatalogPreview',['property' => $this->property,'id'=>$id]);
    }

    public function createByOrder()
    {
        $this->property['title'] = 'Tambah order E Catalog';
        return view($this->name.'create',['property' => $this->property]);
    }

    public function createByFlag()
    {
        $this->property['title'] = 'Tambah order E Catalog';
        return view($this->name.'create',['property' => $this->property]);
    }

    public function edit(Order $id)
    {
        $this->property['title'] = 'Ubah data order';
        return view($this->name.'edit',['property' => $this->property,'data'=>$id]);
    }
    public function show(Order $id)
    {
        $this->property['title'] = 'Detail data order';
        return view($this->name.'show',['property' => $this->property,'data'=>$id]);
    }
}
