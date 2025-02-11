<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Supplier;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public array $property = [
        'main-title'=>'Dompet Kas',
        'index'=>'admin.wallet.index',
    ];
    public string $name ='admin.wallet.';
    public function index()
    {
        return view($this->name."index",['property' => $this->property]);
    }
    public function create()
    {
        $this->property['title'] = 'Tambah dompet Kas';
        return view($this->name.'create',['property' => $this->property]);
    }

    public function edit(Wallet $id)
    {
        $this->property['title'] = 'Ubah data dompet kas';
        return view($this->name.'edit',['property' => $this->property,'data'=>$id]);
    }
    public function show(Wallet $id)
    {
        $this->property['title'] = 'Dompet kas';
        return view($this->name.'show',['property' => $this->property,'data'=>$id]);
    }
    public function createTransaction($id){
        $wallet = Wallet::find($id);
        $this->property['title'] = 'Dompet kas - '.$wallet->name;
        return view($this->name.'transaction',['property' => $this->property,'id'=>$id]);
    }
    public function editTransaction($id,$transaction){
        $wallet = Wallet::find($id);
        $this->property['title'] = 'Dompet kas - '.$wallet->name;
        return view($this->name.'transaction-edit',['property' => $this->property,'id'=>$id,'transaction'=>$transaction]);
    }
}
