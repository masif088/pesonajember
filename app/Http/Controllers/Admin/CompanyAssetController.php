<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyAssetController extends Controller
{
    public function index()
    {
        return view('admin.company-asset.index');
    }
    public function create()
    {
        return view('admin.company-asset.create');
    }
    public function edit($id)
    {
        return view('admin.company-asset.edit',compact('id'));
    }
    public function show($id)
    {
        return view('admin.company-asset.show',compact('id'));
    }
    public function createShrinkage($id)
    {
        return view('admin.company-asset.create-shrinkage',compact('id'));
    }
}
