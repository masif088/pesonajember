<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderPartner;
use App\Models\OrderProduct;
use App\Models\OrderSharingDetail;
use Livewire\Component;

class OrderPreviewDetails extends Component
{
    public $partners=[];
    public $formItem;
    public $orderId;
    public $order;
    public $ppn = 11;
    public $sharing =false;

    public $hpp=[];
    public $sharings;
    public $sharingTitle;

    public function mount()
    {
        $this->order = Order::find($this->orderId);
        $this->ppn = $this->order->ppn;
        $this->sharingTitle = $this->order->orderSharings;


        if ($this->sharing){
            foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
                $orders = [];
                foreach (OrderProduct::where('order_id',$this->orderId)->where('partner_id',$item->partner_id)->get() as $item2){
                    $orders[$item2->id] = $item2;
                    $this->hpp[$item2->id] = $item2->hpp;
                    foreach ($this->order->orderSharings as $s){
                        $this->extracted($s, $item2);
                    }
                }
                $this->partners[$item->partner_id] = [
                    'title' => $item->partner->name,
                    'status' => true,
                    'items'=>$orders,
                ];
            }
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
    public function extracted(mixed $s, mixed $item2): void
    {
        $osd = OrderSharingDetail::where('order_sharing_id', $s->id)->where('order_product_id', $item2->id)->first();
        if ($osd != null) {
            $this->sharings[$s->id][$item2->id] = $osd->percentage;
        } else {
            $this->sharings[$s->id][$item2->id] = 0;
        }
    }
}
