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
        $this->customer = Customer::where('hash_id', $this->hash)->first();
        if ($this->customer==null){
            return $this->redirect(route('frontpage'));
        }

    }

    public function render()
    {
        return view('livewire.customer-site.dashboard');
    }
}
