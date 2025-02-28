<?php

namespace App\Livewire\Wallet;

use Livewire\Component;

class WalletList extends Component
{
    public $wallets;
    public function mount()
    {
if (auth()->user()->role==3) {
    $this->wallets= \App\Models\Wallet::where('user_id',auth()->user()->id)->get();
}else{
    $this->wallets= \App\Models\Wallet::get();
}
    }
    public function render()
    {
        return view('livewire.wallet.wallet-list');
    }
}
