<?php

namespace App\Livewire\Customer;

use App\Repository\Form\Customer as model;
use Livewire\Component;

class CustomerForm extends Component
{
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
        return view('livewire.customer.customer-form');
    }
}
