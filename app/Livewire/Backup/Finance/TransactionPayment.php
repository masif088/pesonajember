<?php

namespace App\Livewire\Backup\Finance;

use App\Repository\FormBackup\TransactionPayment as model;
use Livewire\Component;

class TransactionPayment extends Component
{
    public $action;

    public $dataId;
    public $transactionId;

    public $form;

    public function mount()
    {
        $this->form = form_model(model::class,$this->dataId);
        $this->form['transaction_id']=$this->transactionId;
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();

        $this->form['amount_confirmation'] = $this->form['amount'];
        $this->form['payment_status_id'] = 1;

        model::create($this->form);

        $this->redirect(route('finance.transaction'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('finance.transaction'));
    }


    public function render()
    {
        return view('livewire.finance.transaction-payment');
    }
}
