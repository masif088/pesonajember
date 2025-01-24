<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public array $property = [
        'main-title'=>'Konsumen',
        'index'=>'admin.customer.index',
    ];
    public string $name ='admin.customer.';
    public function index()
    {
        return view($this->name.'index',['property' => $this->property]);
    }
    public function create()
    {
        $this->property['title'] = 'Tambah konsumen';
        return view($this->name.'create',['property' => $this->property]);
    }

    public function edit(Order $id)
    {
        $this->property['title'] = 'Ubah data konsumen';
        return view($this->name.'edit',['property' => $this->property,'data'=>$id]);
    }
    public function show(Order $id)
    {
        $this->property['title'] = 'Detail data konsumen';
        return view($this->name.'show',['property' => $this->property,'data'=>$id]);
    }
}
