<?php

namespace App\Livewire\Order;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderPartner;
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
            $order = Order::find($this->dataId);
//            $this->form['customer_id'] = $order->customer_id;
            $this->form['partners'] = ['1'];
            $this->form['user_id'] = $order->user_id;
//            dd($this->form);

            $this->customerType=1;

        }
    }

    public function getRules()
    {
        return [];
    }

    public function create()
    {
        dd($this->form);
//        dd($this->form);

//        $this->validate();
        $this->resetErrorBag();/**/
//        dd($this->form);

        if ($this->customerType == 2) {
            $customer = $this->form['customer'];
            $customer = Customer::create($customer);
            $this->form['customer_id'] = $customer->id;
        }


        $this->form['transaction_type_id']=$this->transaction_type_id;
        $order = Order::create([
            'transaction_type_id' => $this->form['transaction_type_id'],
            'customer_id' => $this->form['customer_id'],
            'order_number' =>model::getOderNumber(),
            'user_id' => $this->form['user_id'],
        ]);
        foreach ($this->form['partners'] as $partner) {
            OrderPartner::create([
                'order_id' => $order->id,
                'partner_id' => $partner,
            ]);
        }

        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Order telah dibuat',
        ]);
        $this->dispatch('redirect', data: [
            'link' => route('admin.order.input-order',$order->id),
            'timeout'=>2000,
        ]);

    }

    public function update()
    {
        dd($this->form);
//        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route($this->indexPath));
    }

    public function render()
    {
        return view('livewire.order.order-form');
    }
}
