<?php

namespace App\Livewire\Dashboard;

use App\Models\PettyCash;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class DashboardCard extends Component
{


    public $cardsTitle = [];

    public $cardsValue = [];
    public $cardsIcon = [];

    public function mount()
    {
        $totalProduction = 0;
        foreach (Transaction::whereHas('transactionStatuses', function (Builder $q) {
            $q->where('transaction_status_type_id', 10)->whereHas('transactionStatusAttachments', function (Builder $q) {
                $q->where('key', 'qc')->where('value', 'Sesuai standart')->whereDate('created_at', Carbon::now());
            });
        })->get() as $transaction) {
            foreach ($transaction->transactionLists as $list) {
                if ($list->product_id != null) {
                    $totalProduction += intval($list->amount);
                }
            }
        }
        $this->cardsTitle = [
            'Pendapatan Hari Ini',
            'Pengeluaran Hari Ini',
            'Produksi Hari Ini',
            'Transaksi Berjalan',
        ];
        $this->cardsIcon = [
            'ti ti-wallet',
            'ti ti-cash',
            'ti ti-assembly',
            'ti ti-progress-down',
        ];
        $this->cardsValue = [
            'Rp. ' . thousand_format(TransactionPayment::whereDate('payment_at', '=', today())->sum('amount')),
            'Rp. ' . thousand_format(PettyCash::whereDate('date_transaction', '=', today())->sum('credit')),
            $totalProduction . 'pcs',
            Transaction::whereHas('transactionStatus', function (Builder $q) {
                $q->whereNotIn('transaction_status_type_id', [15, 17]);
            })->count() . ' Transaksi',
        ];

    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-card');
    }
}
