<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class MarginController extends Controller
{
    public array $property = [
        'main-title'=>'HPP MARGIN PENJUALAN',
        'index'=>'admin.margin.index',
    ];
    public string $name ='admin.margin.';
    public function index($id)
    {
        $partner = Partner::find($id);
        $this->property['main-title'] .= " $partner->name";
        $transactionType = TransactionType::find($id);
        return view($this->name.'index',['property' => $this->property,'id' => $id,'transactionType' => $transactionType]);
    }
}
