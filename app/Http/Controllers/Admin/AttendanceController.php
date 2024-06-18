<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('admin.attendance.index');
    }
    public function create()
    {
        return view('admin.attendance.create');
    }
    public function edit($id)
    {
        return view('admin.attendance.edit',compact('id'));
    }
    public function show($id)
    {
        return view('admin.attendance.show',compact('id'));
    }
    public function createAttendance($id)
    {
        return view('admin.attendance.create-attendance',compact('id'));
    }
    public function editAttendance($id)
    {
        return view('admin.attendance.edit-attendance',compact('id'));
    }
    public function userAttendance($user)
    {
        return view('admin.attendance.user-attendance',compact('user'));
    }
}
