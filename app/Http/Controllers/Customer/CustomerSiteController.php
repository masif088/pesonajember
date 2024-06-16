<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerSiteController extends Controller
{
    public function customerDashboard($hash)
    {
        return view('customer.index',compact('hash'));
    }
}
