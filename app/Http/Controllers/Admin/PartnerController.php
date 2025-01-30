<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public array $property = [
        'main-title'=>'Partner/CV',
        'index'=>'admin.partner.index',
    ];
    public string $name ='admin.partner.';
    public function index()
    {
        return view($this->name."index",['property' => $this->property]);
    }
    public function create()
    {
        $this->property['title'] = 'Tambah data partner/cv';
        return view($this->name.'create',['property' => $this->property]);
    }

    public function edit(Partner $id)
    {
        $this->property['title'] = 'Ubah data partner/cv';
        return view($this->name.'edit',['property' => $this->property,'data'=>$id]);
    }
    public function show(Partner $id)
    {
        $this->property['title'] = 'Detail data partner/cv';
        return view($this->name.'show',['property' => $this->property,'data'=>$id]);
    }
}
