<?php

namespace App\Livewire\Order;

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
    public function mount()
    {


        foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
            $orders = [];
            foreach (OrderProduct::where('order_id',$this->orderId)->where('partner_id',$item->partner_id)->get() as $item2){
                $orders[$item2->id] = $item2;
                $this->hpp[$item2->id] = $item2->hpp;
            }

            $this->partners[$item->partner_id] = [
                'title' => $item->partner->name,
                'status' => true,
                'items'=>$orders
            ];

        }
    }
    public function render()
    {
        return view('livewire.order.order-hpp');
    }
}
