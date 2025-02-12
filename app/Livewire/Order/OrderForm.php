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

    public $partners;
    public $status;
    public function mount()
    {
        $this->form = form_model(model::class);

        $this->form['partners'] = [];
        $partner= [];
        foreach (\App\Models\Partner::get() as $param) {
            $partner[]=['value'=>$param->id,'title'=>$param->company_name." ".$param->name];
        }
        $this->partners=$partner;

        if ($this->dataId) {



            $order = Order::find($this->dataId);
            $this->status=$order->status;

            $this->form['partners'] = $order->orderPartners->pluck('partner_id')->toArray();
            $this->form['user_id'] = $order->user_id;
            $this->customerType=1;

        }
    }

    public function getRules()
    {
        return [];
    }

    public function create()
    {

        $this->resetErrorBag();

        if ($this->customerType == 2) {
            $customer = $this->form['customer'];
            $customer = Customer::create($customer);
            $this->form['customer_id'] = $customer->id;
        }


        $this->form['transaction_type_id']=$this->transaction_type_id;
        $order = Order::create([
            'transaction_type_id' => $this->form['transaction_type_id'],
            'customer_id' => $this->form['customer_id'],
            'order_number' =>model::getOrderNumber(),
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
//        $this->validate();
        $this->resetErrorBag();
        $o = Order::find($this->dataId);
        $o->update([
            'user_id' => $this->form['user_id'],
            'status' => $this->status,
        ]);
        OrderPartner::where('order_id',$o->id)->delete();
        foreach ($this->form['partners'] as $partner) {
            OrderPartner::create([
                'order_id' => $this->dataId,
                'partner_id' => $partner,
            ]);
        }

        $this->redirect(route($this->indexPath));
    }

    public function render()
    {
        return view('livewire.order.order-form');
    }
}
