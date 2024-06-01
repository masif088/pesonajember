<?php

namespace App\Livewire\Finance;

use App\Livewire\Table\Master;
use App\Models\AccountName;
use Carbon\Carbon;
use Livewire\Component;

class Journal extends Component
{
    public $month;
    public $year;


    public $monthName = [
        'Januari', 'Februari', 'maret',
        'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September',
        'Oktober', 'November', 'Desemeber',
    ];

    public function mount()
    {
        $this->month = Carbon::now()->format('m');
        $this->year = Carbon::now()->format('Y');
    }

    public function incrementMonth()
    {
        if ($this->month != 12) {
            $this->month += 1;
        } else {
            $this->month = 1;
            $this->year += 1;
        }

        $this->dispatch('refreshTable', month: $this->month,year:$this->year)->to(Master::class);
    }

    public function decrementMonth()
    {
        if ($this->month != 1) {
            $this->month -= 1;
        } else {
            $this->month = 12;
            $this->year -= 1;
        }
        $this->dispatch('refreshTable', month: $this->month,year:$this->year)->to(Master::class);
    }

    public function render()
    {
        return view('livewire.finance.journal');
    }
}
