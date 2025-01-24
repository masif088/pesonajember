<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.index');
    }
    public function create()
    {
        return view('admin.employee.create');
    }
    public function edit($id)
    {
        return view('admin.employee.edit',compact('id'));
    }
}
