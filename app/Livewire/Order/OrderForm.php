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
    public $customerType2;

    public $partners;
    public $status;
    public $companyChild;
    public function mount()
    {
        $this->form = form_model(model::class,$this->dataId);

        $this->form['partners'] = [];
        $partner= [];
        foreach (\App\Models\Partner::where('status',1)->get() as $param) {
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

        if($this->customerType2==2){
            $customer2 = $this->form['customer2'];
            $customer2['customer_own']= $this->form['customer_id'];
            $customer2 = Customer::create($customer2);
            $this->form['customer_id'] = $customer2->id;
        }


        $this->form['transaction_type_id']=$this->transaction_type_id;
        $order = Order::create([
            'transaction_type_id' => $this->form['transaction_type_id'],
            'customer_id' => $this->form['customer_id'],
            'order_number' =>model::getOrderNumber(),
            'user_id' => $this->form['user_id'],
            'pph' => $this->form['pph'],
            'ppn' => $this->form['ppn'],
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
            'pph' => $this->form['pph']??0,
            'ppn' => $this->form['ppn']??0,
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
        if ($this->transaction_type_id==3 and $this->customerType2==1){
            $this->companyChild = Customer::where('customer_own',$this->form['customer_id'])->get();
        }
        return view('livewire.order.order-form');
    }
}
