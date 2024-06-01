<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    public function index()
    {
        return view('admin.material.index');
    }

    public function create()
    {
        return view('admin.material.create');
    }

    public function edit($id)
    {
        return view('admin.material.edit', compact('id'));
    }

    public function materialStock($id)
    {
        return view('admin.material.material-stock', compact('id'));
    }

    public function materialStockMutation($id)
    {
        return view('admin.material.material-stock-mutation', compact('id'));
    }

    public function category()
    {
        return view('admin.material.category');
    }

    public function categoryCreate()
    {
        return view('admin.material.category-create');
    }

    public function categoryEdit($id)
    {
        return view('admin.material.category-edit', compact('id'));
    }
}
