<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    public function index()
    {
        return view('admin.selling.index');
    }
}
