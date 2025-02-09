<?php

namespace App\Livewire\ProofOfCash;

use App\Models\OrderPartner;
use App\Repository\Form\ProofOfCash as model;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProofOfCashForm extends Component
{
    use WithFileUploads;

    public $form;

    public $dataId;

    public $action;
    public $indexPath;
    public $partners;
    public $orderId;
    public $partnerId;

    public function mount()
    {
        $this->form = form_model(model::class);
        $this->form['order_id'] = $this->orderId;
        if ($this->partnerId==null){
            $this->partners = OrderPartner::where('order_id',$this->orderId)->get();
        }else{
            $this->form['partner_id'] = $this->partnerId;
        }

        if ($this->dataId) {
            $this->form = form_model(model::class, $this->dataId);
        }
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {

//        dd($this->form);
        $this->validate();
        $this->resetErrorBag();
        $this->form['proof_of_cash_number']=model::getNumber($this->form['partner_id']);
        model::create($this->form);
        if ($this->partnerId!=null){
            $this->redirect(route('admin.proof-of-cash.show',[$this->partnerId,$this->orderId]));
        }else{
            $this->redirect(route('admin.order.show',$this->orderId));
        }
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        if ($this->partnerId!=null){
            $this->redirect(route('admin.proof-of-cash.show',[$this->partnerId,$this->orderId]));
        }else{
            $this->redirect(route('admin.order.show',$this->orderId));
        }
    }


    public function render()
    {
        return view('livewire.proof-of-cash.proof-of-cash-form');
    }
}
