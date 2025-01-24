<?php

namespace App\Livewire\Backup\Material;

use App\Repository\FormBackup\Material as model;
use Livewire\Component;

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
        $this->form['value']=$this->form['stock']*$this->form['valueUnit'];
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
