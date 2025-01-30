<?php

namespace App\Livewire\Order;

use Livewire\Component;

class OrderShowDetailTransaction extends Component
{
    public $orderId;
public $open=true;
public function openAndClose(){
    $this->open=!$this->open;
}
    public function render()
    {
        return view('livewire.order.order-show-detail-transaction');
    }
}
