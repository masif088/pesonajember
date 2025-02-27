<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class EmployeeController extends Controller
{
    public array $property = [
        'main-title'=>'Karyawan',
        'index'=>'admin.employee.index',
    ];
    public string $name ='admin.employee.';
    public function index()
    {
        return view($this->name.'index',['property' => $this->property]);
    }
    public function create()
    {
        $this->property['title'] = 'Tambah Karyawan';
        return view($this->name.'create',['property' => $this->property]);
    }

    public function edit($id)
    {
        $this->property['title'] = 'Ubah data karyawan';
        $data = User::findOrFail($id);
        return view($this->name.'edit',['property' => $this->property,'data'=>$data]);
    }
    public function show(Order $id)
    {
        $this->property['title'] = 'Detail data karyawan';
        return view($this->name.'show',['property' => $this->property,'data'=>$id]);
    }
}
