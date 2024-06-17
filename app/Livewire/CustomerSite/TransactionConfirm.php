<?php

namespace App\Livewire\CustomerSite;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionStatusAttachment;
use Livewire\Component;

class TransactionConfirm extends Component
{
    public $status;
    public $note;
    public $hash;
    public $customer;
    public $transaction;
    public $transactionId;

    public function getRules()
    {
        return [
            'status' => 'required',
            'note' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->customer = Customer::where('hash_id', $this->hash)->first();
        $this->transaction = Transaction::find($this->transaction);
    }

    public function update()
    {

        $ts1 = $this->transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'status')->first();
        $ts1->update([
            'value' => $this->status,
        ]);
        $ts2 = $this->transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'note')->first();
        if ($ts2 != null) {
            $ts2->update([
                'value' => $this->note,
            ]);
        } else {
            TransactionStatusAttachment::create([
                'value' => $this->note,
                'key' => 'note',
                'transaction_status_id' => $this->transaction->transaction_status_id,
                'type' => 'string'
            ]);
        }
        return $this->redirect(route('customer.customer-dashboard',$this->hash));

    }

    public function render()
    {
        return view('livewire.customer-site.transaction-confirm');
    }
}
