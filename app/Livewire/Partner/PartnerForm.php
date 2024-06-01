<?php

namespace App\Livewire\Partner;

use App\Repository\Form\Partner as model;
use Livewire\Component;

class PartnerForm extends Component
{
    public $form;

    public $dataId;

    public $action;

    public function mount()
    {
        $this->form = form_model(model::class);
        if ($this->dataId) {
            $this->form = form_model(model::class, $this->dataId);
        }
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
        $this->redirect(route('partner.index'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('partner.index'));
    }


    public function render()
    {
        return view('livewire.partner.partner-form');
    }
}
