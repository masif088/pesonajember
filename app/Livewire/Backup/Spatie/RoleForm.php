<?php

namespace App\Livewire\Backup\Spatie;

use App\Repository\FormBackup\Role as model;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleForm extends Component
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

        $role = Role::create(['name' => $this->form['role']]);
        $this->form['role']='';
//        model::create($this->form);

//        $this->redirect(route('bank.index'));
    }


    public function render()
    {
        return view('livewire.spatie.role-form');
    }
}
