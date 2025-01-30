<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderPartner;
use App\Models\OrderProduct;
use App\Models\OrderSharingDetail;
use Livewire\Component;

class OrderSharing extends Component
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

    public function mount()
    {
        $this->order = Order::find($this->orderId);
        $this->sharingTitle = $this->order->orderSharings;
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
                foreach ($this->order->orderSharings as $s) {
                    $this->extracted($s, $item2);
                }
            }
        }
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Sharing lainnya berhasil ditambahkan',
        ]);
    }
    public function saveSharing($sId,$pId)
    {
        $osd = OrderSharingDetail::where('order_sharing_id',$sId)->where('order_product_id',$pId)->first();
        if ($osd!=null){
            $osd->update([
                 'percentage'=>$this->sharing[$sId][$pId],
            ]);
        }else{
            OrderSharingDetail::create([
                'order_sharing_id' => $sId,
                'order_product_id' => $pId,
                'percentage'=>$this->sharing[$sId][$pId],
            ]);
        }
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
        return view('livewire.order.order-sharing');
    }

    /**
     * @param mixed $s
     * @param mixed $item2
     * @return void
     */
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
