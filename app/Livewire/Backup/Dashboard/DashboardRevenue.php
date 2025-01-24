<?php

namespace App\Livewire\Backup\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardRevenue extends Component
{
    public $template = [
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0,
        6 => 0,
        7 => 0,
        8 => 0,
        9 => 0,
        10 => 0,
        11 => 0,
        12 => 0,
    ];
    public $data = [];
    public function mount()
    {
        $now = Carbon::now();
        $this->data [$now->year-1] = $this->template;
        $this->data [$now->year] = $this->template;
        $query = "SELECT month(payment_at) as month, year(payment_at) as year, sum(amount_confirmation) as amount  FROM `transaction_payments`
WHERE transaction_payments.payment_status_id=1 and year(payment_at)>=$now->year-1 GROUP BY month, year";
        $data = DB::select($query);
        foreach ($data as $d){
            $this->data[$d->year][$d->month]=$d->amount;
        }
//        dd($this->data);
    }
    public function render()
    {
        return view('livewire.dashboard.dashboard-revenue');
    }
}
