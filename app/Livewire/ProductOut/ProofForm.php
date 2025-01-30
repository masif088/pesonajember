<?php

namespace App\Livewire\ProductOut;

use App\Models\Order;
use App\Models\OrderProductOut;
use App\Models\Partner;
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

    public function mount(){
        $this->partner = Partner::find($this->partnerId);
        $this->order = Order::find($this->orderId);
        $this->out = OrderProductOut::find($this->outId);
    }
    public function render()
    {
        return view('livewire.product-out.proof-form');
    }
}
