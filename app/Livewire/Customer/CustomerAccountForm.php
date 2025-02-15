<?php

namespace App\Livewire\Customer;

use App\Repository\Form\CustomerAccount as model;
use Livewire\Component;

class CustomerAccountForm extends Component
{
    public $form;
    public $dataId;
    public $action;
    public $indexPath;
    public $customerId;

    public function mount()
    {
        $this->form = form_model(model::class);
        $this->form['customer_id'] = $this->customerId;
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
        $this->redirect(route('admin.customer.show', $this->form['customer_id']));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('admin.customer.show', $this->form['customer_id']));
    }
    public function render()
    {
        return view('livewire.customer.customer-account-form');
    }
}
