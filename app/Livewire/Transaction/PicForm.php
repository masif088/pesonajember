<?php

namespace App\Livewire\Transaction;

//use App\Repository\Form\Bank as model;
use App\Models\Transaction;
use App\Models\TransactionStatusAttachment;
use Livewire\Component;

class PicForm extends Component
{
    public $form;

    public $action;

    public $dataId;

    public function mount()
    {
        $this->form = '';
        //        $this->form = form_model(model::class,$this->dataId);
    }

    public function getRules()
    {
        return [
            'form' => 'required|max:255',
        ];
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        $transaction = Transaction::find($this->dataId);

        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();
        if ($ts != null) {
            $ts->update([
                'value' => $this->form,
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'key' => 'pic',
                'value' => $this->form,
                'type' => 'string',
            ]);
        }

        $this->redirect(route('transaction.production'));
    }

    //    public function update()
    //    {
    //
    //        $this->validate();
    //        $this->resetErrorBag();
    //
    //        model::find($this->dataId)->update($this->form);
    //        $this->redirect(route('bank.index'));
    //    }

    public function render()
    {
        return view('livewire.transaction.pic-form');
    }
}
