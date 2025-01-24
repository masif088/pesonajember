<?php

namespace App\Livewire\Backup\Finance;

use App\Models\BigCash;
use App\Repository\FormBackup\PettyCash as model;
use Carbon\Carbon;
use Livewire\Component;

class BigCashFrom extends Component
{
    public $form;

    public $action;

    public $dataId;

    public function mount()
    {
        $this->form = form_model(model::class,$this->dataId);
        $this->form['date_transaction'] = Carbon::parse($this->form['date_transaction'])->format('Y-m-d');
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        $this->form['date_transaction'] = $this->form['date_transaction'] . ' '. Carbon::now()->format('H:i:s');
        BigCash::create($this->form);

        $this->redirect(route('finance.big-cash'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        BigCash::find($this->dataId)->update($this->form);
        $this->redirect(route('finance.big-cash'));
    }

    public function render()
    {
        return view('livewire.finance.petty-cash-from');
    }
}
