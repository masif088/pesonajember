<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralInfoController extends Controller
{
    public function index()
    {
        return view('admin.general-info.index');
    }
    public function create()
    {
        return view('admin.general-info.create');
    }
    public function edit($id)
    {
        return view('admin.general-info.edit',compact('id'));
    }
}
