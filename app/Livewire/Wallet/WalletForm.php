<?php

namespace App\Livewire\Wallet;

use App\Models\Order;
use App\Repository\Form\Wallet as model;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class WalletForm extends Component
{
    public $orderId;

    use WithFileUploads;

    public $form;

    public $dataId;

    public $action;
    public $indexPath;

    public function mount()
    {
        $this->form = form_model(model::class);
        $this->form['order_id'] = $this->orderId;
        if ($this->dataId) {
            $this->form = form_model(model::class, $this->dataId);
        }
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        model::create($this->form);
        $this->redirect(route('admin.wallet.index'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('admin.wallet.index'));
    }

    public function render()
    {
        return view('livewire.wallet.wallet-form');
    }
}
