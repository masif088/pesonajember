<?php

namespace App\Livewire\ProductOut;

use App\Models\Order;
use App\Models\OrderProductOut;
use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProofForm extends Component
{
    use WithFileUploads;
    public $orderId;
    public $partnerId;
    public $outId;

    public $order;
    public $partner;
    public $out;

    public $poWaybill;
    public $poProduct;

    public $waybill;
    public $product;

    public function mount(){
        $this->partner = Partner::find($this->partnerId);
        $this->order = Order::find($this->orderId);
        $this->out = OrderProductOut::find($this->outId);
    }
//    public function upload(){
//        $this->uploadFile();
//
////        if ($this->poProduct)
//
//    }
    public function render()
    {
        return view('livewire.product-out.proof-form');
    }

    public function uploadFile(): void
    {
        if ($this->poProduct != null) {
            $order =  Order::find($this->orderId);
            $mockup = $this->poProduct;
            $now = Carbon::now();
            $filename = Str::slug($order->order_number.'-'.$now->toIso8601ZuluString()) . '.' . $mockup->getClientOriginalExtension();
            $mockup->storeAs('public/po-product', $filename);

            $this->out->update([
                'proof_of_product_out'=>'po-product/' . $filename
            ]);
            $this->dispatch('swal:alert', data: [
                'icon' => 'success',
                'title'=>'Bukti barang keluar berhasil di upload',
            ]);
        }

        if ($this->poWaybill != null) {
            $order =  Order::find($this->orderId);
            $mockup = $this->poWaybill;
            $now = Carbon::now();
            $filename = Str::slug($order->order_number.'-'.$now->toIso8601ZuluString()) . '.' . $mockup->getClientOriginalExtension();
            $mockup->storeAs('public/po-waybill', $filename);
            $this->out->update([
                'proof_of_waybill'=>'po-waybill/' . $filename
            ]);
            $this->dispatch('swal:alert', data: [
                'icon' => 'success',
                'title'=>'Bukti surat jalan berhasil di upload',
            ]);
        }
//        $this->redirect(route('admin.product-out.show', [$this->partnerId,$this->orderId]));

    }
}
