<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;

class MutationStatusController extends Controller
{
    public function index()
    {
        return view('admin.mutation-status.index');
    }

    public function create()
    {
        return view('admin.mutation-status.create');
    }

    public function edit($id)
    {
        return view('admin.mutation-status.index', compact('id'));
    }

}
