<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use App\Models\OrderProofOfCash;
use App\Models\OrderSharingDetail;
use Carbon\Carbon;
use Livewire\Component;

class MonthlyProfit extends Component
{
    public $icon;
    public $increase;

    public $profits;
    public $totalProfit;


    public function mount()
    {
        $now = Carbon::now();
        $total = OrderProofOfCash::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->sum('nominal');
        $prevMonth = $now->subMonth();
        $totalPrev = OrderProofOfCash::whereMonth('created_at', $prevMonth->month - 1)->whereYear('created_at', $prevMonth->year)->sum('nominal');

        if ($total == 0 || $totalPrev == 0) {
            $increase = 0;
        } else {
            $increase = number_format(($totalPrev - $total) / $totalPrev * 100, 2, ',', '.');
        }
        if ($increase < 0) {
            $icon = "<i class='text-red-500  ti to-arrow-down'> </i>";
        } else if ($increase > 0) {
            $icon = "<i class='text-green-500  ti to-arrow-up'> </i>";
        } else {
            $icon = "<i class='text-green-500 '> </i> -";
        }
        $this->icon = $icon;
        $this->increase = $increase;


        $orders = Order::where('status', 3)->get();
        $tt = 0;
        $type = [1 => 0, 2 => 0, 3 => 0,];
        foreach ($orders as $order) {
            if ($order->transaction_type_id == 3) {
                $type[$order->transaction_type_id] += $order->value * $order->percentage;
            } else {

                $allHppValue = $order->orderProducts->sum('hpp_value');
                $afterTax = 0;
                $ppn = $order->ppn;

                $allSharing = 0;
                foreach ($order->orderProducts as $item2) {
                    $afterTax += getTax($item2->value, $ppn, $item2->pph);
                    foreach ($order->orderSharings as $s) {
                        $osd = OrderSharingDetail::where('order_sharing_id', $s->id)->where('order_product_id', $item2->id)->first();
                        if ($osd != null) {
                            $allSharing += $osd->percentage * getTax(($item2->price * $item2->quantity), $ppn, $item2->pph) / 100;
                        }
                    }
                }

                $margin = $afterTax - $allHppValue - $allSharing;
                $type[$order->transaction_type_id] += $margin;
            }
        }
//            dd($type);
        foreach ($type as $t) {
            $tt += $t;
        }
        $this->totalProfit = $tt;
        $this->profits = $type;


    }

    public function render()
    {
        return view('livewire.dashboard.monthly-profit');
    }
}
