<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProductOut;
use App\Models\Partner;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SalaryController extends Controller
{
    public array $property = [
        'main-title'=>'Gaji karyawan',
        'index'=>'admin.salary.index',
    ];
    public string $name ='admin.salary.';
    public function index()
    {
        return view($this->name.'index',['property' => $this->property]);
    }
    public function create()
    {
        $this->property['title'] = 'Tambah data gaji';
        return view($this->name.'create',['property' => $this->property]);
    }

    public function edit(Salary $id)
    {
        $this->property['title'] = 'Ubah data gaji';
        return view($this->name.'edit',['property' => $this->property,'data'=>$id]);
    }
    public function show($id)
    {
        $salary = Salary::find($id);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.salary', compact('id', 'salary'));
        return $pdf->stream();
    }
}
