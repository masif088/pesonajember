<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        return view('admin.supplier.index');
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function edit($id)
    {
        return view('admin.supplier.edit', compact('id'));
    }

    public function category()
    {
        return view('admin.supplier.category');
    }

    public function categoryCreate()
    {
        return view('admin.supplier.category-create');
    }

    public function categoryEdit($id)
    {
        return view('admin.supplier.category-edit', compact('id'));
    }
}
