<?php

namespace App\Livewire\CustomerSite;

use Livewire\Component;

class TransactionMockup extends Component
{
    public $hash;
    public $transaction;
    public $customer;
    public function render()
    {
        return view('livewire.customer-site.transaction-mockup');
    }
}
