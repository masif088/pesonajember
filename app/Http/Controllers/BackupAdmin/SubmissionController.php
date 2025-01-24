<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    public function index()
    {
        return view('admin.submission.index');
    }

    public function create()
    {
        return view('admin.submission.create');
    }

    public function edit($id)
    {
        return view('admin.submission.edit', compact('id'));
    }

    public function show($id)
    {
        return view('admin.submission.show', compact('id'));
    }
}
