<?php

namespace App\Livewire\Order;

use App\Models\Customer;
use App\Models\Order;
use App\Repository\Form\Order as model;
use Livewire\Component;

class OrderForm extends Component
{
    public $form;

    public $dataId;

    public $action;
    public $indexPath;
    public $transaction_type_id;
    public $customerType;

    public function mount()
    {
        $this->form = form_model(model::class);
        if ($this->dataId) {
            $this->form = form_model(model::class, $this->dataId);
        }
    }

    public function getRules()
    {
        return ;
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        if ($this->customerType == 2) {
            $customer = $this->form['customer'];
            $customer = Customer::create($customer);
            $this->form['customer_id'] = $customer->id;
        }

        $order = Order::create([
            'transaction_type_id' => $this->form['transaction_type_id'],
            'customer_id' => $this->form['customer_id'],
            'order_number' =>model::getOderNumber(),
            'user_id' => $this->form['user_id'],
        ]);


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
        return view('livewire.order.order-form');
    }
}
