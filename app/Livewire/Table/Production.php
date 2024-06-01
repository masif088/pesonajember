<?php

namespace App\Livewire\Table;

use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionStatusAttachment;

class Production extends Master
{
    public function changeProduction($id, $status)
    {
        $transaction = Transaction::find($id);
        $ts = $transaction->transactionStatuses->where('transaction_status_type_id', '=', $status)->first();

        if ($ts == null) {
            $ts = TransactionStatus::create([
                'transaction_id' => $id,
                'transaction_status_type_id' => $status,
            ]);
        }

        $transaction->update([
            'transaction_status_id' => $ts->id,
        ]);

        $this->dispatch('reRender');

    }

    public function changeMockupStatus($id, $status)
    {
        TransactionStatusAttachment::find($id)->update([
            'value' => $status,
        ]);
        $this->dispatch('reRender');
    }
}
