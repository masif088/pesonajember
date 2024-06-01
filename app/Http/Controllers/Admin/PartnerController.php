<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return view('admin.partner.index');
    }

    public function create()
    {
        return view('admin.partner.create');
    }

    public function edit($id)
    {
        return view('admin.partner.edit', compact('id'));
    }

    public function category()
    {
        return view('admin.partner.category');
    }

    public function categoryCreate()
    {
        return view('admin.partner.category-create');
    }

    public function categoryEdit($id)
    {
        return view('admin.partner.category-edit', compact('id'));
    }
}
