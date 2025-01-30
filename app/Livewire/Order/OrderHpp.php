<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderPartner;
use App\Models\OrderProduct;
use Livewire\Component;

class OrderHpp extends Component
{
    public $partners=[];
    public $formItem;
    public $orderId;
    public $pph=1.5;
    public $ppn=11;
    public $hpp=[];
    public $order;
    public function mount()
    {
        $this->order = Order::find($this->orderId);
        foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
            $orders = [];
            foreach (OrderProduct::where('order_id',$this->orderId)->where('partner_id',$item->partner_id)->get() as $item2){
                $orders[$item2->id] = $item2;
                $this->hpp[$item2->id] = $item2->hpp;
            }
            $this->partners[$item->partner_id] = [
                'title' => $item->partner->name,
                'status' => true,
                'items'=>$orders,
            ];

        }
    }
    public function addHpp ()
    {
        $this->resetErrorBag();

        foreach ($this->hpp as $id => $hpp) {
            $op = OrderProduct::find($id);
            $op->update([
                'hpp' => $hpp,
                'hpp_value' => $hpp*$op->quantity,
            ]);
        }
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Hpp berhasil ditambahkan',
        ]);
        $this->dispatch('redirect', data: [
            'link' => route('admin.margin.index',$this->order->transaction_type_id),
            'timeout'=>2000,
        ]);
    }
    public function openAndClose($p)
    {
        $this->partners[$p]['status'] = !$this->partners[$p]['status'];
    }
    public function render()
    {
        return view('livewire.order.order-hpp');
    }
}
