<?php

namespace App\Livewire\Finance;

use App\Livewire\Table\Master;
use App\Models\AccountName;
use Carbon\Carbon;
use Livewire\Component;

class CalcProfitAndLoss extends Component
{
    public $month;

    public $year;
    public $month2;

    public $year2;

    public $accountName;

    public $accountNameId = null;

    public $optionAccountNames;
    public $debit=0;
    public $credit=0;
    public $total=0;

    public function mount()
    {
        $this->optionAccountNames = [];
        foreach (AccountName::get() as $an) {
            $this->optionAccountNames[] = [
                'value' => $an->id,
                'title' => $an->code.' - '.$an->title,
            ];
        }
        $this->accountName = AccountName::find($this->accountNameId);
        $this->month = Carbon::now()->format('m');
        $this->year = Carbon::now()->format('Y');

        $this->dispatch('select2dispatch');
    }

    public function incrementMonth()
    {
        if ($this->month != 12) {
            $this->month += 1;
        } else {
            $this->month = 1;
            $this->year += 1;
        }

        $this->dispatch('refreshTable', month: $this->month, year: $this->year)->to(Master::class);
    }

    public function decrementMonth()
    {
        if ($this->month != 1) {
            $this->month -= 1;
        } else {
            $this->month = 12;
            $this->year -= 1;
        }
        $this->dispatch('refreshTable', month: $this->month, year: $this->year)->to(Master::class);
    }

    public $monthName = [
        'Januari', 'Februari', 'maret',
        'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September',
        'Oktober', 'November', 'Desemeber',
    ];
    public function render()
    {
        return view('livewire.finance.calc-profit-and-loss');
    }
}
