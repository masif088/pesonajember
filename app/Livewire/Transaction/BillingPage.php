<?php

namespace App\Livewire\Transaction;

use App\Models\Customer;
use App\Models\Transaction;
use Livewire\Component;

class BillingPage extends Component
{
    public $dataId;

    public $transaction;
    public $paymentModel;

    public $user;

    public $waNumber;

    public function mount()
    {
        $this->transaction = Transaction::find($this->dataId);
        $this->paymentModel = explode(':',$this->transaction->paymentModel->model);
        $this->user = Customer::find($this->transaction->customer_id);
        if ($this->user->no_phone != null) {
            if ($this->user->no_phone[0] == 0) {
                $originalNumber = $this->user->no_phone;
                $countryCode = '62';
                $internationalNumber = preg_replace('/^0/', $countryCode, $originalNumber);
                $this->waNumber = $internationalNumber;
            }
        }
    }

    public function sendMessage()
    {
        $d = $this->transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'status document')->first();
        $d->update([
            'value' => 'Terkirim',
        ]);
    }

    public function render()
    {
        return view('livewire.transaction.billing-page');
    }
}
