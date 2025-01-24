<?php

namespace App\Livewire\Backup\Salary;

use App\Repository\FormBackup\Salary as model;
use Livewire\Component;

class SalaryForm extends Component
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
//dd($this->form);
        $this->validate();
        $this->resetErrorBag();

        model::create($this->form);

        $this->redirect(route('salary.index'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);
        $this->redirect(route('salary.index'));
    }

    public function render()
    {
        return view('livewire.salary.salary-form');
    }
}
