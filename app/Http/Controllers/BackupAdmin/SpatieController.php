<?php

namespace App\Http\Controllers\BackupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpatieController extends Controller
{
    public function index()
    {
        return view('admin.spatie.index');
    }
    public function roleCreate()
    {
        return view('admin.spatie.create-role');
    }
    public function permissionCreate()
    {
        return view('admin.spatie.create-permission');
    }
    public function roleSetPermission()
    {
        return view('admin.spatie.role-set-permission');
    }
    public function userSetRole()
    {
        return view('admin.spatie.user-set-role');
    }

}
