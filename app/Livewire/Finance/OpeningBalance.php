<?php

namespace App\Livewire\Finance;

use App\Repository\Form\AccountOpeningBalance as model;
use Livewire\Component;

class OpeningBalance extends Component
{
    public $form;

    public $action;

    public $dataId;

    public function mount()
    {
        $this->form = form_model(model::class,$this->dataId);
//        dd($this->form);
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

        $this->redirect(route('finance.account-opening-balance'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);
        $this->redirect(route('finance.account-opening-balance'));
    }
    public function render()
    {
        return view('livewire.finance.opening-balance');
    }
}
