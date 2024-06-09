<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class TransactionDetail extends Component
{
    public $dataId;
    public $transaction;
    public function mount()
    {
        $this->transaction=Transaction::find($this->dataId);
    }
    public function render()
    {
        return view('livewire.transaction.transaction-detail');
    }
}
