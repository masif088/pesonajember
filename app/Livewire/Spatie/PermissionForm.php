<?php

namespace App\Livewire\Spatie;

use App\Repository\Form\Permission as model;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Component
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

        $permission = Permission::create(['name' => $this->form['permission']]);
        $this->form['permission']='';
//        model::create($this->form);

//        $this->redirect(route('pers.index'));
    }


    public function render()
    {
        return view('livewire.spatie.permission-form');
    }
}
