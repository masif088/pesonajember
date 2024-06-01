<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use App\Models\TransactionStatusAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class MockupForm extends Component
{
    use WithFileUploads;

    public $dataId;

    public $mockup;
    public $process;

    public function mount()
    {
        $transaction = Transaction::find($this->dataId);
//dd($transaction);
    }

    public function getRules()
    {
        return [
            'mockup' => 'required|image|max:5120',
        ];
    }

    public function create()
    {
        $this->validate();
        $transaction = Transaction::find($this->dataId);

        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'photo mockup')->first();
        $ts2 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'status mockup')->first();
        $ts3 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'process')->first();
        if ($ts != null) {
            $ts->update([
                'value' => $this->mockup->store(path: 'public/mockup'),
            ]);
            $ts2->update([
                'value' => 'Menunggu konfirmasi',
            ]);
            $ts2->update([
                'value' => $this->process,
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'type' => 'string',
                'key' => 'photo mockup',
                'value' => $this->mockup->store(path: 'public/mockup'),
            ]);
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'type' => 'string',
                'key' => 'status mockup',
                'value' => 'Menunggu konfirmasi',
            ]);
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'type' => 'string',
                'key' => 'process',
                'value' => $this->process,
            ]);

        }
        $this->redirect(route('transaction.mockup-site'));

    }

    public function render()
    {
        return view('livewire.transaction.mockup-form');
    }
}
