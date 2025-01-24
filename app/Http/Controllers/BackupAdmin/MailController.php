<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        return view('admin.mail.index');
    }
    public function create()
    {
        return view('admin.mail.create');
    }
}
