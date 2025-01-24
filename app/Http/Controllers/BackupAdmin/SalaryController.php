<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Support\Facades\App;

class SalaryController extends Controller
{
    public function index()
    {
        return view('admin.salary.index');
    }

    public function create()
    {
        return view('admin.salary.create');
    }

    public function edit($id)
    {
        return view('admin.salary.edit', compact('id'));
    }

    public function download($id)
    {
        $data = [
            'salary' => Salary::find($id),
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.salary', $data);
        return $pdf->stream();
    }
}
