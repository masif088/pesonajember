<?php

namespace App\Livewire\Invoice;

use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\OrderProofOfCash;
use Carbon\Carbon;
use Livewire\Component;

class InvoiceForm extends Component
{
    public $orderId;
    public $partnerId;
    public $order;
    public $action='create';
    public $dataId;
    public $shippingCost=0;
    public $tax=0;
    public $dp=0;
    public function mount(){
        $this->order = Order::find($this->orderId);
        if ($this->dataId!=null){
            $invoice = OrderInvoice::find($this->dataId);
            $this->shippingCost = $invoice->shipping_cost;
            $this->tax = $invoice->tax;
            $this->dp = $invoice->down_payment;
        }
    }

    public function create(){
        OrderInvoice::create([
            'order_id'=>$this->orderId,
            'partner_id'=>$this->partnerId,
            'invoice_number'=>$this->getNumber(),
            'shipping_cost'=>$this->shippingCost,
            'down_payment'=>$this->dp,
            'tax'=>$this->tax
        ]);
        if ($this->partnerId!=null){
            $this->redirect(route('admin.invoice.index',[$this->partnerId]));
        }else{
            $this->redirect(route('admin.order.show',$this->orderId));
        }
    }
    public function update(){
        OrderInvoice::find($this->dataId)->update([
            'shipping_cost'=>$this->shippingCost,
            'down_payment'=>$this->dp,
            'tax'=>$this->tax
        ]);
        if ($this->partnerId!=null){
            $this->redirect(route('admin.invoice.index',[$this->partnerId]));
        }else{
            $this->redirect(route('admin.order.show',$this->orderId));
        }
    }
    public  function getNumber() :string
    {
        $partner = \App\Models\Partner::find($this->partnerId);
        $now  = Carbon::now();
        $count = OrderInvoice::where('partner_id', $partner->id)
                ->whereDate('created_at', $now)->count()+1;
        return getNumberFormat($count,$partner->format_number_invoice,$now);
    }
    public function render()
    {
        return view('livewire.invoice.invoice-form');
    }
}
