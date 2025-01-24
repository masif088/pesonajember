<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;

class ShipperController extends Controller
{
    public function index()
    {
        return view('admin.shipper.index');
    }

    public function create()
    {
        return view('admin.shipper.create');
    }

    public function edit($id)
    {
        return view('admin.shipper.edit', compact('id'));
    }
}
