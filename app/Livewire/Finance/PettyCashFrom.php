<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use App\Repository\Form\PettyCash as model;

class PettyCashFrom extends Component
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

        $this->redirect(route('finance.big-cash'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);
        $this->redirect(route('finance.big-cash'));
    }

    public function render()
    {
        return view('livewire.finance.petty-cash-from');
    }
}
