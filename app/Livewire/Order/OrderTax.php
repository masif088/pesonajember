<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderPartner;
use App\Models\OrderProduct;
use App\Models\OrderSharingDetail;
use Livewire\Component;

class OrderTax extends Component
{
    public $partners=[];
    public $formItem;
    public $orderId;
    public $pph=1.5;
    public $ppn=11;
    public $hpp=[];
    public $order;

    public $sharingTitle;
    public $title;
    public $sharing;
    public $taxPph;
    public $buttonDisable=false;

    public function mount()
    {
        $this->order = Order::find($this->orderId);
        $this->sharingTitle = $this->order->orderSharings;
$this->updateData();
    }
    public function updateData(){
        foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
            $orders = [];
            foreach (OrderProduct::where('order_id',$this->orderId)->where('partner_id',$item->partner_id)->get() as $item2){
                $orders[$item2->id] = $item2;
                $this->hpp[$item2->id] = $item2->hpp;
                $this->taxPph[$item2->id] = $item2->pph;
            }
            $this->partners[$item->partner_id] = [
                'title' => $item->partner->name,
                'status' => true,
                'items'=>$orders,
            ];
        }
    }
    public function addSharing()
    {
        $this->resetErrorBag();
        \App\Models\OrderSharing::create([
            'order_id' => $this->orderId,
            'title' => $this->title,
        ]);
        $this->sharingTitle = $this->order->orderSharings;
        foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
            foreach (OrderProduct::where('order_id', $this->orderId)->where('partner_id', $item->partner_id)->get() as $item2) {
                $this->taxPph[$item2->id] = $item2->pph;
//                foreach ($this->order->orderSharings as $s) {
//                    $this->extracted($s, $item2);
//                }
            }
        }
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Sharing lainnya berhasil ditambahkan',
        ]);
    }
    public function saveSharing($pId)
    {
        $this->buttonDisable=true;
        if (is_numeric($this->taxPph[$pId])){
            $op = OrderProduct::find($pId);
            $op->update([
                'pph'=>$this->taxPph[$pId],
            ]);
        }
        $this->updateData();
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Berhasil mengubah pph',
        ]);
        $this->buttonDisable=false;


    }
    public function deleteItem($id)
    {
        $s= \App\Models\OrderSharing::find($id);
        $title = $s->title;
        $s->delete();
        $this->sharingTitle = $this->order->orderSharings;
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>"Sharing $title berhasil dihapus",
        ]);
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
        return view('livewire.order.order-tax');
    }
    public function extracted(mixed $s, mixed $item2): void
    {
        $osd = OrderSharingDetail::where('order_sharing_id', $s->id)->where('order_product_id', $item2->id)->first();
        if ($osd != null) {
            $this->sharing[$s->id][$item2->id] = $osd->percentage;
        } else {
            $this->sharing[$s->id][$item2->id] = 0;
        }
    }
}
