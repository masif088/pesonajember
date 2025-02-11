<?php

namespace App\Livewire\Wallet;

use App\Repository\Form\WalletDetail as model;
use Livewire\Component;
use Livewire\WithFileUploads;

class WalletTransactionCreate extends Component
{

    use WithFileUploads;

    public $form;

    public $walletId;
    public $dataId;

    public $action;
    public $indexPath;

    public function mount()
    {
        $this->form = form_model(model::class);
        $this->form['wallet_id'] = $this->walletId;
        $this->form['user_id'] = auth()->id();
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
        $this->redirect(route('admin.wallet.show', $this->walletId));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('admin.wallet.show', $this->walletId));
    }
    public function render()
    {
        return view('livewire.wallet.wallet-transaction-create');
    }
}
