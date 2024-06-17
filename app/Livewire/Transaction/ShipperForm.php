<?php

namespace App\Livewire\Transaction;

use App\Models\Shipper;
use App\Models\Transaction;
use App\Models\TransactionStatusAttachment;
use Livewire\Component;

class ShipperForm extends Component
{
    public $form;
    public $form2;

    public $action;

    public $dataId;
    public $sample;

    public $option;

    public function mount()
    {
        $this->option = eloquent_to_options(Shipper::get(),'title','title');
        $this->form = $this->option[0]['title'];
        $this->form2 = '';
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

        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'ekpedisi pengiriman')->first();
        $ts2 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'resi pengiriman')->first();
        if ($this->sample==1){
            $ts3 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'status')->first();
        }
        if ($ts != null) {
            $ts->update([
                'value' => $this->form,
            ]);
            $ts2->update([
                'value' => $this->form2,
            ]);
            if ($this->sample==1){
                $ts3->update([
                    'value' => 'Menunggu konfirmasi',
                ]);
            }
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'key' => 'ekpedisi pengiriman',
                'value' => $this->form,
                'type' => 'string',
            ]);
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'key' => 'resi pengiriman',
                'value' => $this->form2,
                'type' => 'string',
            ]);
            if ($this->sample==1){
                TransactionStatusAttachment::create([
                    'transaction_status_id' => $transaction->transaction_status_id,
                    'type' => 'string',
                    'key' => 'status',
                    'value' => 'Menunggu konfirmasi',
                ]);
            }
        }

        if ($this->sample==1){
            $this->redirect(route('transaction.sample-site'));
        }else{
            $this->redirect(route('transaction.production'));
        }

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
        return view('livewire.transaction.shipper-form');
    }
}
