<?php

namespace App\Livewire\Backup\Cooperative;

use App\Repository\FormBackup\Cooperative as model;
use Livewire\Component;

class CooperativeForm extends Component
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

        $this->redirect(route('cooperative.index'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);
        $this->redirect(route('cooperative.index'));
    }
    public function render()
    {
        return view('livewire.cooperative.cooperative-form');
    }
}
