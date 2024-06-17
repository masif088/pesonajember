<?php

namespace App\Livewire\Transaction;

//use App\Repository\Form\Bank as model;
use App\Models\Transaction;
use App\Models\TransactionStatusAttachment;
use App\Models\User;
use Livewire\Component;

class PicForm extends Component
{
    public $form;

    public $action;

    public $dataId;
    public $optionUser;

    public function mount()
    {
        $transaction = Transaction::find($this->dataId);
        $this->optionUser = eloquent_to_options(User::orderBy('name')->get(),'id','name');

//        dd($this->form);
        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();
        if ($ts != null) {
            $this->form = $ts->value;
        } else {
            $this->form = $this->optionUser[0]['value'];
        }
    }

    public function getRules()
    {
        return [
            'form' => 'required',
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
                'type' => 'App\Models\User',
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
