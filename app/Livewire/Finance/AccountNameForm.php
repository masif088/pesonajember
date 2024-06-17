<?php

namespace App\Livewire\Finance;

use App\Repository\Form\AccountName as model;
use Livewire\Component;

class AccountNameForm extends Component
{
    public $form;

    public $action;

    public $dataId;

    public function mount()
    {
        $this->form = form_model(model::class,$this->dataId);
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        model::create($this->form);

        $this->redirect(route('bank.index'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);
        $this->redirect(route('bank.index'));
    }

    public function render()
    {
        return view('livewire.finance.account-name-form');
    }
}
