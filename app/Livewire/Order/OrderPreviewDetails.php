<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderPartner;
use App\Models\OrderProduct;
use Livewire\Component;

class OrderPreviewDetails extends Component
{
    public $partners=[];
    public $formItem;
    public $orderId;
    public $order;
    public $pph = 1.5;
    public $ppn = 11;


    public function mount()
    {
        $this->order = Order::find($this->orderId);

        foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
            $this->partners[$item->partner_id] = [
                'title' => $item->partner->name,
                'status' => true,
                'items'=>OrderProduct::where('order_id',$this->orderId)->where('partner_id',$item->partner_id)->get()
            ];
        }
    }



    public function openAndClose($p)
    {
        $this->partners[$p]['status'] = !$this->partners[$p]['status'];
    }
    public function render()
    {
        return view('livewire.order.order-preview-details');
    }
}
