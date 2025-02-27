<?php

namespace App\Livewire\Employee;

use App\Repository\Form\User as model;
use Livewire\Component;

class EmployeeForm extends Component
{
    public $form;

    public $action;

    public $dataId;

    public function mount()
    {
//        dd("asd");
        $this->form = form_model(model::class, $this->dataId);
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

        $this->form['password'] = bcrypt($this->form['password']);
        model::create($this->form);

        $this->redirect(route('admin.employee.index'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();
        if ($this->form['password']==null) {
            unset($this->form['password']);
        }
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('admin.employee.index'));
    }

    public function render()
    {
        return view('livewire.employee.employee-form');
    }
}
