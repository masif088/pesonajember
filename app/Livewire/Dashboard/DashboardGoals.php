<?php

namespace App\Livewire\Dashboard;

use App\Models\Transaction;
use App\Models\TransactionPayment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class DashboardGoals extends Component
{
    public $production = 0;

    public $production2 = 0;

    public $productionGoals = 25;

    public $revenue = 0;

    public $revenue2 = 0;

    public $revenueGoals = 10000;

    public function mount()
    {
        $this->revenue = TransactionPayment::whereMonth('payment_at', '=', \Carbon\Carbon::now()->month)->sum('amount');
        $this->revenue2 = TransactionPayment::whereMonth('payment_at', '=', \Carbon\Carbon::now()->subMonth()->month)->sum('amount');
        $totalProduction = 0;
        foreach (Transaction::whereHas('transactionStatuses', function (Builder $q) {
            $q->where('transaction_status_type_id', 10)->whereHas('transactionStatusAttachments', function (Builder $q) {
                $q->where('key', 'qc')
                    ->where('value', 'Sesuai standart')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            });
        })->get() as $transaction) {
            foreach ($transaction->transactionLists as $list) {
                if ($list->product_id != null) {
                    $totalProduction += intval($list->amount);
                }
            }
        }
        $this->production = $totalProduction;
        $totalProduction = 0;
        foreach (Transaction::whereHas('transactionStatuses', function (Builder $q) {
            $q->where('transaction_status_type_id', 10)->whereHas('transactionStatusAttachments', function (Builder $q) {
                $q->where('key', 'qc')
                    ->where('value', 'Sesuai standart')
                    ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
            });
        })->get() as $transaction) {
            foreach ($transaction->transactionLists as $list) {
                if ($list->product_id != null) {
                    $totalProduction += intval($list->amount);
                }
            }
        }
        $this->production2 = $totalProduction;
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-goals');
    }
}
