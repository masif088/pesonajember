<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class OrderShowDetailTransaction extends Component
{
    public $orderId;
    public $open;
    public $order;
    public function mount(){
        //0 detail transaction
        //0 kwitansi
        $this->open[0]=true;
        $this->open[1]=false;
        $this->open[2]=false;
        $this->open[3]=false;
        $this->open[4]=true;
        $this->order=Order::find($this->orderId);
    }

    public function openAndClose($id)
    {
        $this->open[$id] = !$this->open[$id];
    }

    public function render()
    {
        return view('livewire.order.order-show-detail-transaction');
    }
}
