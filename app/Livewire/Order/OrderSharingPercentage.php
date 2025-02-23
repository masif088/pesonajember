<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderPartner;
use App\Models\OrderProduct;
use App\Models\OrderSharingDetail;
use Livewire\Component;

class OrderSharingPercentage extends Component
{
    public $partners=[];
    public $formItem;
    public $orderId;
    public $pph=1.5;
    public $ppn=11;
    public $hpp=[];
    public $order;

    public $percentage=0;
    public $value=0;
    public $contractValue;

    public $sharingTitle;
    public $title;
    public $sharing;
    public $buttonDisable=false;

    public function mount()
    {
        $this->contractValue = 0;
        $this->order = Order::find($this->orderId);
        $this->percentage =$this->order->percentage??0;
        $this->value = $this->order->value??0;
        $this->sharingTitle = $this->order->orderSharings;
        foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
            foreach (OrderProduct::where('order_id',$this->orderId)->where('partner_id',$item->partner_id)->get() as $item2){
                $this->contractValue +=$item2->value;
            }
        }
    }

    public function update()
    {
        $this->resetErrorBag();
        $this->order->update([
            'percentage'=>$this->percentage,
            'value'=>$this->value,
        ]);

        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Sharing berhasil ditambahkan',
        ]);

        $this->dispatch('redirect', data: [
            'link' => route('admin.margin.index',3),
            'timeout'=>2000,
        ]);
    }



    public function render()
    {
        return view('livewire.order.order-sharing-percentage');
    }
}
