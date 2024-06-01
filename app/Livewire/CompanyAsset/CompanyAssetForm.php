<?php

namespace App\Livewire\CompanyAsset;

use App\Repository\Form\CompanyAsset as model;
use Livewire\Component;

class CompanyAssetForm extends Component
{
    public $form;

    public $action;

    public $dataId;

    public function mount()
    {
        $this->form = form_model(model::class, $this->dataId);
        $this->form['last_shrinkage'] = 0;
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {

        $this->validate();
        $this->resetErrorBag();

        $this->form['value_now'] = $this->form['value'];

        model::create($this->form);

        $this->redirect(route('company-asset.index'));
    }

    public function update()
    {

        $this->validate();
        $this->resetErrorBag();

        model::find($this->dataId)->update($this->form);
        $this->redirect(route('company-asset.index'));
    }

    public function render()
    {
        return view('livewire.company-asset.company-asset-form');
    }
}
