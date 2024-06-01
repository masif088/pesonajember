<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use App\Models\TransactionStatusAttachment;
use Livewire\Component;

class QcForm extends Component
{
    public $form;

    public $form2;

    public $action;

    public $dataId;

    public function mount()
    {
        $this->form = 'Sesuai standart';
        $this->form2 = '';
    }

    public function getRules()
    {
        return [
            'form' => 'required|max:255',
            'form2' => 'required|max:255',
        ];
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();

        $transaction = Transaction::find($this->dataId);

        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'qc')->first();
        $ts2 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'qc note')->first();
        if ($ts != null) {
            $ts->update([
                'value' => $this->form,
            ]);
            $ts2->update([
                'value' => $this->form2,
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'key' => 'qc',
                'value' => $this->form,
                'type' => 'string',
            ]);
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'key' => 'qc note',
                'value' => $this->form2,
                'type' => 'string',
            ]);
        }


        $this->redirect(route('transaction.production'));
    }

    public function render()
    {
        return view('livewire.transaction.qc-form');
    }
}
