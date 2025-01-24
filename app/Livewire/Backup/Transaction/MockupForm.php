<?php

namespace App\Livewire\Backup\Transaction;

use App\Models\Transaction;
use App\Models\TransactionList;
use App\Models\TransactionStatusAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class MockupForm extends Component
{
    use WithFileUploads;

    public $dataId;

    public $mockup;

    public $mockupCustomer;

    public $sample;

    public $process;

    public function mount()
    {

        $transaction = Transaction::find($this->dataId);
        //dd($transaction);
    }

    public function getRules()
    {
        return [
            'mockupCustomer' => 'nullable',
        ];
    }

    public function create()
    {
        $this->validate();
        $transaction = Transaction::find($this->dataId);

        $ts2 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'status')->first();
        $ts4 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'pdf mockup')->first();

        $filename = pathinfo($this->mockupCustomer->getClientOriginalName(),PATHINFO_FILENAME);

        if ($ts2 != null) {
            $ts2->update([
                'value' => 'Menunggu konfirmasi',
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'type' => 'string',
                'key' => 'status',
                'value' => 'Menunggu konfirmasi',
            ]);
        }

        if ($ts4 != null) {
            $ts4->update([
                'value' => $this->mockupCustomer->storeAs('public/mockup-pdf', $this->mockupCustomer->getClientOriginalName()),
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'type' => 'file',
                'key' => 'pdf mockup',
                'value' => $this->mockupCustomer->storeAs('public/mockup-pdf', $this->mockupCustomer->getClientOriginalName()),
            ]);
        }

        $this->redirect(route('transaction.index','Mockup'));

    }

    public function render()
    {
        return view('livewire.transaction.mockup-form');
    }
}
