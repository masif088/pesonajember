<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAccount;
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

    public function edit(Customer $id)
    {
        $this->property['title'] = 'Ubah data konsumen';
        return view($this->name.'edit',['property' => $this->property,'data'=>$id]);
    }
    public function show(Customer $id)
    {
        $this->property['title'] = 'Detail data konsumen';
        return view($this->name.'show',['property' => $this->property,'data'=>$id]);
    }

    public function createAccount(Customer $id)
    {
        $this->property['title'] = 'Tambah data bank konsumen';
        return view($this->name.'account.create',['property' => $this->property,'data'=>$id]);
    }

    public function editAccount(Customer $id,CustomerAccount $account)
    {
        $this->property['title'] = 'Ubah data bank konsumen';
        return view($this->name.'account.edit',['property' => $this->property,'data'=>$id,'account'=>$account]);
    }
}
