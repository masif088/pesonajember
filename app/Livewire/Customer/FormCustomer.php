<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use App\Repository\Form\Customer as model;
use Carbon\Carbon;
use Livewire\Component;

class FormCustomer extends Component
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
        $now = Carbon::now();
        $count = Customer::whereYear('register','=',$now->year)->get()->count();
        $this->form['register'] = $now;
        $this->form['hash_id'] = quickRandom(32);
        $this->form['uid'] = 'WSHK' . $now->year.(str_pad(($count+1), 4, '0', STR_PAD_LEFT));
        model::create($this->form);

        $this->redirect(route('customer.index'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);
        $this->redirect(route('customer.index'));
    }

    public function render()
    {
        return view('livewire.customer.form-customer');
    }
}
