<?php

namespace App\Livewire\Supplier;

use Livewire\Component;

class TransactionChart extends Component
{
    public $dataId;
    public $chart;
    public function mount(){
        $this->chart = [
            'type'=>'bar',
            'height'=>'300',
            'categories'=>['Januari','Feb'],
            'data'=>[
                [
                    'label'=>'Pengeluaran',
                    'value'=>[10,90,80,1,234,131]
                ],
                [
                    'label'=>'Pemasukan',
                    'value'=>[10,90,1080,10,2034,131]
                ],
            ]
        ];
    }
    public function render()
    {
        return view('livewire.supplier.transaction-chart');
    }
}
