<?php

namespace App\Livewire\Partner;

use App\Repository\Form\Partner as model;
use Livewire\Component;
use Livewire\WithFileUploads;

class PartnerForm extends Component
{
    use WithFileUploads;
    public $form;

    public $dataId;

    public $action;
    public $indexPath;

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
        $kop = $this->form['kop_image'];
        unset($this->form['kop_image']);
        $logo = $this->form['logo_image'];
        unset($this->form['logo_image']);

        $this->validate();
        $this->resetErrorBag();
        model::create($this->form);
        $this->redirect(route($this->indexPath));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route($this->indexPath));
    }
    public function render()
    {
        return view('livewire.partner.partner-form');
    }
}
