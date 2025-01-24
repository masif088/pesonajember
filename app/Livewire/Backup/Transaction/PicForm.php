<?php

namespace App\Livewire\Backup\Transaction;

//use App\Repository\Form\Bank as model;
use App\Models\TransactionList;
use App\Models\TransactionStatusAttachment;
use App\Models\User;
use Livewire\Component;

class PicForm extends Component
{
    public $form;

    public $redirect;

    public $action;

    public $dataId;

    public $checkbox = false;

    public $optionUser;

    public function mount()
    {
        $transaction = TransactionList::find($this->dataId);
        $this->optionUser = eloquent_to_options(User::orderBy('name')->get(), 'id', 'name');

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

        $transaction = TransactionList::find($this->dataId);
        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'pic')->first();

                TransactionStatusAttachment::create([
                    'transaction_status_id' => $transaction->transaction_status_id,
                    'key' => 'pic',
                    'value' => $this->form,
                    'type' => 'App\Models\User',
                ]);


        $tsId = $transaction->transactionStatus->transaction_status_type_id;
        redirect_production($tsId);
    }

    public function render()
    {
        return view('livewire.transaction.pic-form');
    }
}
