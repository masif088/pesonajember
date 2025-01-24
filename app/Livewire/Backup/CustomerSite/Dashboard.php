<?php

namespace App\Livewire\Backup\CustomerSite;

use App\Models\Customer;
use Livewire\Component;

class Dashboard extends Component
{
    public $hash;

    public $customer;
    public $transactionMockups = [];
    public $transactionSamples = [];

    public function mount()
    {
        $this->customer = Customer::where('hash_id', $this->hash)->first();
        if ($this->customer == null) {
            return $this->redirect(route('frontpage'));
        }

        foreach ($this->customer->transactions as $transaction) {
            $tsa = $transaction->transactionStatus;
            if ($tsa != null) {
                $tsa = $transaction->transactionStatus->transactionStatusAttachments;
                if ($tsa != null) {
                    $tsa = $transaction->transactionStatus->transactionStatusAttachments->where('value', '=', 'Menunggu konfirmasi')->first() ?? null;
                    if ($tsa != null) {
                        $this->transactionMockups[] = $transaction;
                    }
                }
            }
            foreach ($transaction->transactionLists as $t) {
                $tsa = $t->transactionStatus;
                if ($tsa != null) {
                    $tsa = $t->transactionStatus->transactionStatusAttachments;
                    if ($tsa != null) {
                        $tsa = $t->transactionStatus->transactionStatusAttachments->where('value', '=', 'Menunggu konfirmasi')->first() ?? null;
                        if ($tsa != null) {
                            $this->transactionSamples[] = $t;
                        }
                    }
                }
            }
        }

    }

    public function render()
    {
        return view('livewire.customer-site.dashboard');
    }
}
