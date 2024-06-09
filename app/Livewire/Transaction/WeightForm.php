<?php

namespace App\Livewire\Transaction;

use App\Models\Shipper;
use App\Models\Transaction;
use App\Models\TransactionStatusAttachment;
use Livewire\Component;

class WeightForm extends Component
{
    public $form;
    public $form2;

    public $action;

    public $dataId;

    public $option;

    public function mount()
    {
        $this->option = eloquent_to_options(Shipper::get(), 'title', 'title');
        $this->form = $this->option[0]['title'];
        $transaction = Transaction::find($this->dataId);
        $ts2 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'berat pengiriman')->first();
        if ($ts2==null){

            $this->form2 = '';
        }else{
            $this->form2 = $ts2->value;
        }
//        if ($ts2 != null) {
//            $ts2->update([
//                'value' => $this->form2,
//            ]);
        //        $this->form = form_model(model::class,$this->dataId);
    }

    public function getRules()
    {
        return [
            'form' => 'required|max:255',
        ];
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        $transaction = Transaction::find($this->dataId);
        $ts2 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'berat pengiriman')->first();
        if ($ts2 != null) {
            $ts2->update([
                'value' => $this->form2,
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'key' => 'berat pengiriman',
                'value' => $this->form2,
                'type' => 'string',
            ]);
        }

        $this->redirect(route('transaction.production'));
    }

    //    public function update()
    //    {
    //
    //        $this->validate();
    //        $this->resetErrorBag();
    //
    //        model::find($this->dataId)->update($this->form);
    //        $this->redirect(route('bank.index'));
    //    }
    public function render()
    {
        return view('livewire.transaction.weight-form');
    }
}
