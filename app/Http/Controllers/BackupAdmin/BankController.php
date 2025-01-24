<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        return view('admin.bank.index');
    }
    public function create()
    {
        return view('admin.bank.create');
    }
    public function edit($id)
    {
        return view('admin.bank.edit',compact('id'));
    }

}
