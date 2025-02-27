<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderPartner;
use App\Models\OrderProduct;
use Livewire\Component;

class OrderPreview extends Component
{
    public $partners=[];
    public $formItem;
    public $orderId;
    public $order;
    public $pph = 1.5;
    public $ppn = 11;
    public $type;


    public function mount()
    {
        $this->order = Order::find($this->orderId);
        $this->ppn = $this->order->ppn;
        $this->type = $this->order->transaction_type_id;

        foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
            $this->partners[$item->partner_id] = [
                'title' => $item->partner->name,
                'status' => true,
                'items'=>OrderProduct::where('order_id',$this->orderId)->where('partner_id',$item->partner_id)->get()
            ];
        }
        $this->setNullForm();
    }

    public function setNullForm()
    {

        $this->formItem = ['partner_id' => null, 'name' => null, 'price' => null, 'quantity' => null, 'value' => null,];
    }
    public function getRules()
    {
        return [
            'formItem.partner_id' => 'required',
            'formItem.name' => 'required',
            'formItem.price' => 'required|numeric',
            'formItem.quantity' => 'required|numeric',
        ];
    }


    public function confirmOrder(){
        $this->order->update([
            'status'=> 1
        ]);
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Order diaktifkan',
        ]);
        $this->dispatch('redirect', data: [
            'link' => route('admin.order.index'),
            'timeout'=>2000,
        ]);
    }

    public function getTax(){

    }

    public function openAndClose($p)
    {
        $this->partners[$p]['status'] = !$this->partners[$p]['status'];
    }
    public function render()
    {
        return view('livewire.order.order-preview');
    }
}
