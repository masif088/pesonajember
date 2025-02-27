<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class CompleteTransaction extends Component
{
    public $orderId;
    public $order;
    public $total;
//    public $
    public function mount(){
        $this->order = Order::find($this->orderId);
$this->getAll();
    }

//    public function getAll(){
//        foreach ($this->order->orderProducts as $orderProduct){
//            if ($this->order->transaction_type_id!=3){
//                $orderProduct->value-$orderProduct->-getTax($orderProduct->value,$this->order->ppn,$orderProduct->pph);
//            }
//        }
//    }

    public function endTransaction()
    {
        $this->dispatch('swal:confirm', data: [
            'icon' => 'warning',
            'title' => 'apakah anda yakin ingin menyelesaikan transaksi ini, setelah anda menyelesaikan anda tidak bisa melakukan perubahan lagi',
            'confirmText' => 'Selesaikan',
            'method' => 'delete',
        ]);

    }

    public function render()
    {
        return view('livewire.order.complete-transaction');
    }
}
