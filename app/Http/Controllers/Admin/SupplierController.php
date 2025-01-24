<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public $property = [
        'main-title'=>'Supplier',
        'index'=>'admin.supplier.index',
    ];
    public function index()
    {
        return view('admin.supplier.index',['property' => $this->property]);
    }
    public function create()
    {
        $this->property['title'] = 'Tambah data supplier';
        return view('admin.supplier.create',['property' => $this->property]);
    }

    public function edit(Supplier $id)
    {
        $this->property['title'] = 'Ubah data supplier';
        return view('admin.supplier.edit',['property' => $this->property,'supplier'=>$id]);
    }
    public function show(Supplier $id)
    {
        $this->property['title'] = 'Detail data supplier';
        return view('admin.supplier.show',['property' => $this->property,'data'=>$id]);
    }
}
