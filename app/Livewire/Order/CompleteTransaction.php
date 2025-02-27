<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderSharingDetail;
use Livewire\Component;

class CompleteTransaction extends Component
{
    public $orderId;
    public $order;
    public $total;

//    public $
    public function mount()
    {
        $this->order = Order::find($this->orderId);

    }

    public function getAll()
    {

        if ($this->order->transaction_type_id != 3) {

            $afterTax = 0;
            foreach ($this->order->orderProducts as $op) {
                $dpp = $op->value * 100 / (100 + $this->order->ppn);
                $ppnProduct = $op->value - $dpp;
                $pphProduct = $op->pph * $dpp / 100;
                $afterTax += ($dpp - $pphProduct);
            }

            $allSharing = 0;
            foreach ($this->order->orderProducts as $item2) {
                $afterTax += getTax($item2->value, $this->order->ppn, $item2->pph);
                foreach ($this->order->orderSharings as $s) {
                    $osd = OrderSharingDetail::where('order_sharing_id', $s->id)->where('order_product_id', $item2->id)->first();
                    if ($osd != null) {
                        $allSharing += $osd->percentage * getTax(($item2->price * $item2->quantity), $this->order->ppn, $item2->pph) / 100;
                    }
                }
            }
            $allHppValue = $this->order->orderProducts->sum('hpp_value');
            $margin = $afterTax - $allHppValue - $allSharing;

            return $margin;
        } else {

            return $this->order->value * $this->order->percentage / 100;
        }
    }

    public function endTransaction()
    {
        $this->dispatch('swal:confirm', data: ['icon' => 'warning', 'title' => 'apakah anda yakin ingin menyelesaikan transaksi ini, setelah anda menyelesaikan anda tidak bisa melakukan perubahan lagi', 'confirmText' => 'Selesaikan', 'method' => 'delete',]);

    }

    public function render()
    {
        return view('livewire.order.complete-transaction');
    }
}
