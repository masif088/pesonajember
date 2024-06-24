<?php

namespace App\Livewire\Transaction;

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
            'mockup' => 'nullable|image|max:5120',
            'process' => 'nullable',
            'mockupCustomer' => 'nullable',
        ];
    }

    public function create()
    {
        $this->validate();
        $transaction = TransactionList::find($this->dataId);

        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'photo mockup')->first();
        $ts2 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'status')->first();
        $ts3 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'process')->first();
        $ts4 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'pdf mockup')->first();

        if ($this->sample!=1){
            if ($ts != null) {
                $ts->update([
                    'value' => $this->mockup->store(path: 'public/mockup'),
                ]);
            } else {
                TransactionStatusAttachment::create([
                    'transaction_status_id' => $transaction->transaction_status_id,
                    'type' => 'image',
                    'key' => 'photo mockup',
                    'value' => $this->mockup->store(path: 'public/mockup'),
                ]);
            }
            if ($ts3 != null) {
                $ts3->update([
                    'value' => $this->process,
                ]);
            } else {
                TransactionStatusAttachment::create([
                    'transaction_status_id' => $transaction->transaction_status_id,
                    'type' => 'string',
                    'key' => 'process',
                    'value' => $this->process,
                ]);
            }
        }

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
                'value' => $this->mockupCustomer->store(path: 'public/mockup-pdf'),
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'type' => 'file',
                'key' => 'pdf mockup',
                'value' => $this->mockupCustomer->store(path: 'public/mockup-pdf'),
            ]);
        }
        if ($this->sample == "1") {
            $this->redirect(route('transaction.sample-site'));
        } else {

            $this->redirect(route('transaction.mockup-site'));
        }

    }

    public function render()
    {
        return view('livewire.transaction.mockup-form');
    }
}
