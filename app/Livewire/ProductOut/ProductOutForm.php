<?php

namespace App\Livewire\ProductOut;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductOut;
use App\Models\OrderProductOutDetail;
use App\Models\Partner;
use Livewire\Component;
use function Laravel\Prompts\form;

class ProductOutForm extends Component
{
    public $orderId;
    public $partnerId;
    public $order;
    public $partner;
    public $form = [];
    public $action='create';
    public $outId ;
    public function mount()
    {
        $this->order = Order::find($this->orderId);
        $this->partner = Partner::find($this->partnerId);
        foreach($this->order->orderProducts as $index=>$op){
            $this->form['orderProduct'][$op->id] = 0;
        }
        $this->form['note']='';
        if ($this->outId!=null){
//            dd($this->outId);
            $op =  OrderProductOut::find($this->outId);
            $this->form['note']=$op->note;
            foreach($op->orderProductOutDetails as $opd){
                $this->form['orderProduct'][$opd->order_product_id]=$opd->quantity;
            }
        }
    }
    public function create()
    {
        $this->resetErrorBag();
        $opo = OrderProductOut::create([
            'order_id' => $this->orderId,
            'partner_id' => $this->partnerId,
            'note' => $this->form['note'],
        ]);
         foreach($this->form['orderProduct'] as $key => $op){
             OrderProductOutDetail::create([
                 'order_product_out_id' => $opo->id,
                 'order_product_id' => $key,
                 'quantity' => $op
             ]);
         }

        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Surat keluar berhasil dibuat',
        ]);
        $this->dispatch('redirect', data: [
            'link' => route('admin.product-out.show',[$this->partnerId, $this->orderId]),
            'timeout'=>2000,
        ]);

    }
    public function update(){
        $this->resetErrorBag();
        $opo = OrderProductOut::find($this->outId);
        $opo->update([
            'note' => $this->form['note'],
        ]);
        foreach($opo->orderProductOutDetails as $opd){
            OrderProductOutDetail::find($opd->id)->update([
                'quantity' => $this->form['orderProduct'][$opd->order_product_id]
            ]);
        }

        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title'=>'Surat keluar berhasil diubah',
        ]);
        $this->dispatch('redirect', data: [
            'link' => route('admin.product-out.show',[$this->partnerId, $this->orderId]),
            'timeout'=>2000,
        ]);
    }
    public function render()
    {
        return view('livewire.product-out.product-out-form');
    }
}
