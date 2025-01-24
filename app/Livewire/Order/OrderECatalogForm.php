<?php

namespace App\Livewire\Order;

use App\Models\Customer;
use App\Models\Order;
use App\Repository\Form\Order as model;
use Livewire\Component;

class OrderECatalogForm extends Component
{
    public $form;

    public $dataId;

    public $action;
    public $customerType;
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
        return view('livewire.order.order-e-catalog-form');
    }
}
