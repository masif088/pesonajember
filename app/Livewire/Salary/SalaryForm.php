<?php

namespace App\Livewire\Salary;

use App\Repository\Form\Salary as model;
use Livewire\Component;
use Livewire\WithFileUploads;

class SalaryForm extends Component
{
    use WithFileUploads;

    public $form;

    public $dataId;

    public $action;
    public $indexPath;

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
        $this->redirect(route($this->indexPath));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route($this->indexPath));
    }
    public function render()
    {
        return view('livewire.salary.salary-form');
    }
}
