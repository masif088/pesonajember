<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customer.index');
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function edit($id)
    {
        return view('admin.customer.edit', compact('id'));
    }
}
