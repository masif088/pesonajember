<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class SalaryController extends Controller
{
    public function download($id)
    {
        $data = [
            'salary' => \App\Models\Salary::find($id),
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.salary', $data);
        return $pdf->stream();
    }
}
