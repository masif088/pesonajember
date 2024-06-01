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
        $this->form = form_model(model::class, $this->dataId);
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        $this->form['password'] = bcrypt($this->form['password']);
        model::create($this->form);

        $this->redirect(route('employee.index'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);
        $this->redirect(route('employee.index'));
    }

    public function render()
    {
        return view('livewire.employee.employee-form');
    }
}
