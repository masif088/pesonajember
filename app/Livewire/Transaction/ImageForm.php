<?php

namespace App\Livewire\Transaction;

use App\Models\TransactionList;
use App\Models\TransactionStatusAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageForm extends Component
{
    use WithFileUploads;

    public $dataId;

    public $image;

    public function getRules()
    {
        return [
            'image' => 'required|image|max:5120',
        ];
    }

    public function create()
    {
        $this->validate();
        $transaction = TransactionList::find($this->dataId);

        //        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'Foto')->first();
        //        if ($ts != null) {
        //            $ts->update([
        //                'value' => $this->image->store(path: 'public/photo'),
        //            ]);
        //        } else {
        //        }
        TransactionStatusAttachment::create([
            'transaction_status_id' => $transaction->transaction_status_id,
            'type' => 'image',
            'key' => 'foto',
            'value' => $this->image->store(path: 'public/mockup'),
        ]);
        $tsId = $transaction->transactionStatus->transaction_status_type_id;
        redirect_production($tsId);
    }

    public function render()
    {
        return view('livewire.transaction.image-form');
    }
}
