<?php

namespace App\Livewire\Backup\Cooperative;

use App\Models\Cooperative;
use App\Models\CooperativeCreditEmployee;
use App\Repository\FormBackup\CreditEmployee as model;
use Livewire\Component;

class CreditEmployeeForm extends Component
{
    public $form;

    public $action;

    public $dataId;

    public function mount()
    {
        $this->form = form_model(model::class, $this->dataId);
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        $e = CooperativeCreditEmployee::where('user_id', $this->form['cooperative_credit_employee_id'])->first();
        if ($e == null) {
            $e = CooperativeCreditEmployee::create([
                'user_id' => $this->form['cooperative_credit_employee_id'],
                'credit' => 0,
            ]);
        }
        $this->form['cooperative_credit_employee_id'] = $e->id;

        $e->update([
            'credit' => $e->credit + $this->form['debit'] - $this->form['credit'],
        ]);

        Cooperative::create([
            'title'=>$this->form['title'],
            'date_transaction'=>$this->form['date_transaction'],
            'debit'=>$this->form['debit'],
            'credit'=>$this->form['credit']
        ]);

        model::create($this->form);

        $this->redirect(route('cooperative.index'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();
        $data = model::find($this->dataId);
        $e = CooperativeCreditEmployee::where('user_id', $this->form['cooperative_credit_employee_id'])->first();
        if ($e == null) {
            $e = CooperativeCreditEmployee::create([
                'user_id' => $this->form['cooperative_credit_employee_id'],
                'credit' => 0,
            ]);
        }
        $this->form['cooperative_credit_employee_id'] = $e->id;

        $e->update([
            'credit' => $e->credit + $this->form['debit'] - $data->debit - $this->form['credit'] + $data->credit,
        ]);
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('cooperative.index'));
    }

    public function render()
    {
        return view('livewire.cooperative.credit-employee-form');
    }
}
