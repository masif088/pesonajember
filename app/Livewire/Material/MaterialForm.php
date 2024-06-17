<?php

namespace App\Livewire\Material;

use Livewire\Component;
use App\Repository\Form\Material as model;

class MaterialForm extends Component
{
    public $form;
    public $action;
    public $dataId;
    public function mount ()
    {
        $this->form=form_model(model::class,$this->dataId,$this->action);

    }
    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {
//        dd($this->form);
        $this->validate();
        $this->resetErrorBag();
        model::create($this->form);
        $this->redirect(route('material.index'));
    }
    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('material.index'));
    }
    public function render()
    {
        return view('livewire.material.material-form');
    }
}
