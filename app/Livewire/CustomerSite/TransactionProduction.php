<?php

namespace App\Livewire\CustomerSite;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionStatusAttachment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TransactionProduction extends Component
{
    public $hash;

    public $transaction;

    public $transactionId;

    public $customer;

    public function mount()
    {
        $this->customer = Customer::where('hash_id', $this->hash)->first();
        if ($this->customer == null) {
            return $this->redirect(route('frontpage'));
        }
        $this->transaction = Transaction::find($this->transactionId);
        if ($this->transaction->customer_id != $this->customer->id) {
            return $this->redirect(route('frontpage'));
        }
    }



    public function render()
    {
        return view('livewire.customer-site.transaction-production');
    }
}
