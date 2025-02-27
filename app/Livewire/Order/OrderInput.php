<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\OrderPartner;
use App\Models\OrderProduct;
use App\Models\Partner;
use Livewire\Component;

class OrderInput extends Component
{

    public $partners=[];
    public $formItem;
    public $orderId;
public  $order;
    public function mount()
    {
        $this->order= Order::find($this->orderId);

        foreach (OrderPartner::where('order_id',$this->orderId)->get() as $item) {
            $this->partners[$item->partner_id] = [
                'title' => $item->partner->name,
                'status' => false,
                'items'=>OrderProduct::where('order_id',$this->orderId)->where('partner_id',$item->partner_id)->get()
            ];
        }
        $this->setNullForm();
    }

    public function setNullForm()
    {

        $this->formItem = ['partner_id' => null, 'name' => null, 'price' => null, 'quantity' => null, 'value' => null,'pph'=>$this->order->pph];
    }
    public function getRules()
    {
        return [
            'formItem.partner_id' => 'required',
            'formItem.name' => 'required',
            'formItem.price' => 'required|numeric',
            'formItem.quantity' => 'required|numeric',
        ];
    }

    public function addItem()
    {

        $this->validate();
        $this->resetErrorBag();
        $this->formItem['order_id']=$this->orderId;
        $this->formItem['value']=$this->formItem['quantity']*$this->formItem['price'];

        OrderProduct::create($this->formItem);
        $this->partners[$this->formItem['partner_id']]['status'] = true;
        $this->partners[$this->formItem['partner_id']]['items'] =OrderProduct::where('order_id',$this->orderId)->where('partner_id',$this->formItem['partner_id'])->get();
        $this->setNullForm();
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Berhasil menambahkan item',
        ]);
    }
    public function deleteItem($id){
        $op = OrderProduct::find($id);
        $p = $op->partner_id;
        if ($op!=null){
            $op->delete();
        }
        $this->partners[$p]['items'] =OrderProduct::where('order_id',$this->orderId)->where('partner_id',$p)->get();
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Berhasil menghapus item',
        ]);
    }


    public function openAndClose($p)
    {
        $this->partners[$p]['status'] = !$this->partners[$p]['status'];
    }

    public function render()
    {
        return view('livewire.order.order-input');
    }
}
