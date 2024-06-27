<?php

namespace App\Livewire\Table;

use App\Models\Transaction;
use App\Models\TransactionList;
use App\Models\TransactionStatus;
use App\Models\TransactionStatusAttachment;
use Carbon\Carbon;

class Production extends Master
{
    public function changeProduction($id, $status)
    {
        $transaction = TransactionList::find($id);
        $ts = $transaction->transactionStatuses->where('transaction_status_type_id', '=', $status)->first();

        if ($ts == null) {
            $ts = TransactionStatus::create([
                'transaction_id' => $transaction->transaction_id,
                'transaction_list_id' => $transaction->id,
                'transaction_status_type_id' => $status,
            ]);
        }

        $transaction->update([
            'transaction_status_id' => $ts->id,
        ]);

        $this->dispatch('reRender');

    }
    public function changeTransaction($id, $status)
    {
        $transaction = Transaction::find($id);
        $ts = $transaction->transactionStatuses->where('transaction_status_type_id', '=', $status)->first();



        if ($ts == null) {
            $ts = TransactionStatus::create([
                'transaction_id' => $transaction->id,
                'transaction_list_id' => null,
                'transaction_status_type_id' => $status,
            ]);
        }

        if ($status==14){
            foreach ($transaction->transactionLists as $tl){
                $ts = TransactionStatus::create([
                    'transaction_list_id' => $tl->id,
                    'transaction_id' => $transaction->id,
                    'transaction_status_type_id' => 4,
                ]);
                TransactionList::find($tl->id)->update([
                    'transaction_status_id' => $ts->id
                ]);
            }
        }

        $transaction->update([
            'transaction_status_id' => $ts->id,
        ]);

        $this->dispatch('reRender');

    }

    public function submitApproval($transactionList)
    {
        $tl = TransactionList::find($transactionList);
        TransactionStatusAttachment::create([
            'transaction_status_id' => $tl->transaction_status_id,
            'type' => 'string',
            'key' => 'status',
            'value' => 'Menunggu konfirmasi',
        ]);
        $this->dispatch('reRender');
    }

    public function changeMockupStatus($id, $status)
    {
        $tsa = TransactionStatusAttachment::find($id);
        $tsa->transactionStatus->update(['updated_at' => Carbon::now()]);
        $transaction = $tsa->transactionStatus->transaction;

        $tsa->update([
            'value' => $status,
        ]);
        $this->dispatch('reRender');
    }
}
