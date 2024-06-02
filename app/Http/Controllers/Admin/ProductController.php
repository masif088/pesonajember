<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function edit($id)
    {
        return view('admin.product.edit', compact('id'));
    }

    public function category()
    {
        return view('admin.product.category');
    }

    public function categoryCreate()
    {
        return view('admin.product.category-create');
    }

    public function categoryEdit($id)
    {
        return view('admin.product.category-edit', compact('id'));
    }

}
