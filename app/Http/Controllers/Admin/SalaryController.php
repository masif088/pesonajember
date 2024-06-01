<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function download($id)
    {
        $data = [
            'salary' => \App\Models\Salary::find(1),
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.salary', $data);
        return $pdf->stream();
    }
}
