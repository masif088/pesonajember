<?php

namespace App\Livewire\Transaction;

use App\Models\Shipper;
use App\Models\TransactionList;
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
        $this->option = eloquent_to_options(Shipper::get(), 'title', 'title');
        $this->form = $this->option[0]['title'];
        $this->form2 = '';
        //        $this->form = form_model(model::class,$this->dataId);
    }

    public function getRules()
    {
        return [
            'form' => 'required|max:255',
            'form2' => 'required|max:255',
        ];
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        $transaction = TransactionList::find($this->dataId);
        $tsa = $transaction->transactionStatus->transaction_status_type_id;
        $ts = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'ekpedisi pengiriman')->first();
        $ts2 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'resi pengiriman')->first();
        if ($tsa != 14) {
            $ts3 = $transaction->transactionStatus->transactionStatusAttachments->where('key', '=', 'status')->first();
        }
        if ($ts != null) {
            $ts->update([
                'value' => $this->form,
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'key' => 'ekpedisi pengiriman',
                'value' => $this->form,
                'type' => 'string',
            ]);
        }
        if ($ts2 != null) {
            $ts2->update([
                'value' => $this->form2,
            ]);
        } else {
            TransactionStatusAttachment::create([
                'transaction_status_id' => $transaction->transaction_status_id,
                'key' => 'resi pengiriman',
                'value' => $this->form2,
                'type' => 'string',
            ]);
        }
        if ($ts3 != null) {
            if ($tsa != 14) {
                $ts3->update([
                    'value' => 'Menunggu konfirmasi',
                ]);
            }
        } else {
            if ($tsa != 14) {
                TransactionStatusAttachment::create([
                    'transaction_status_id' => $transaction->transaction_status_id,
                    'type' => 'string',
                    'key' => 'status',
                    'value' => 'Menunggu konfirmasi',
                ]);
            }
        }

        if ($tsa == 12 or $tsa == 13) {
            $this->redirect(route('transaction.index','Pengiriman'));
        } else {
            $this->redirect(route('transaction.sample-site'));
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
