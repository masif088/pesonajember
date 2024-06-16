<?php

namespace App\Livewire\CustomerSite;

use App\Models\Customer;
use Livewire\Component;

class Dashboard extends Component
{
    public $hash;
    public $customer;
    public function mount()
    {
//        $this->customer = Customer::where('hash_id',$this->hash)->first();

    }
    public function render()
    {
        return view('livewire.customer-site.dashboard');
    }
}
