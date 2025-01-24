<?php

namespace App\Livewire\Backup\Transaction;

use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionStatusAttachment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TransactionDetail extends Component
{
    public $dataId;
    public $transaction;

    public function mount()
    {
        $this->transaction=Transaction::find($this->dataId);
    }
    public function getTrack($ts)
    {
        $transaction = TransactionStatus::find($ts);
        $transactionShipper = $transaction->transactionStatusAttachments->where('key', 'ekpedisi pengiriman')->first();
        $transactionResi = $transaction->transactionStatusAttachments->where('key', 'resi pengiriman')->first();
        $transactionTracking = $transaction->transactionStatusAttachments->where('key', 'traking pengiriman')->first();
        if ($transactionTracking != null) {
            if (Carbon::now()->subHour()->lessThan($transactionTracking->updated_at)) {
                return;
            }
        }

        $headers = [
            'content-type' => 'application/json',
            'authorization' => config('app.biteship'),
        ];

        $apiURL = "https://api.biteship.com/v1/trackings/$transactionResi->value/couriers/$transactionShipper->value";
        $response = Http::withHeaders($headers)->get($apiURL);

        if ($response->json()['success']) {
            if ($transactionTracking != null) {
                $transactionTracking->update(['value' => json_encode($response->json())]);
            } else {
                TransactionStatusAttachment::create([
                    'value' => json_encode($response->json()),
                    'key' => 'traking pengiriman',
                    'type' => 'string',
                    'transaction_status_id' => $ts,
                ]);
            }
        }

        $this->render();
    }
    public function render()
    {
        return view('livewire.transaction.transaction-detail');
    }
}
