<?php

namespace App\Livewire\Backup\Shipper;

use App\Repository\FormBackup\Shipper as model;
use Livewire\Component;

class ShipperForm extends Component
{
    public $action;
    public $form;
    public $dataId;

    public function mount()
    {
        $this->form = form_model(model::class);
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

        $this->redirect(route('shipper.index'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);

        $this->redirect(route('shipper.index'));
    }

    public function render()
    {
        return view('livewire.shipper.shipper-form');
    }
}
