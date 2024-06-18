<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use function Termwind\terminal;

class CooperativeController extends Controller
{
    public function index()
    {
        return view('admin.cooperative.index');
    }

    public function create()
    {
        return view('admin.cooperative.create');
    }

    public function edit($id)
    {
        return view('admin.cooperative.edit', compact('id'));
    }

    public function creditEmployee()
    {
        return view('admin.cooperative.credit-employee');
    }

    public function creditEmployeeDetail($user)
    {
        return view('admin.cooperative.credit-employee-detail',compact('user'));
    }
    public function creditEmployeeCreate()
    {
        return view('admin.cooperative.credit-employee-create');
    }
    public function creditEmployeeEdit($id)
    {
        return view('admin.cooperative.credit-employee',compact('id'));
    }
}
