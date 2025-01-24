<?php

namespace App\Livewire\Backup\Production;

use App\Repository\FormBackup\ProductCategory as model;
use Livewire\Component;

class CategoryForm extends Component
{
    public $form;
    public $dataId;
    public $action;

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
        $this->redirect(route('production.category'));

    }
    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('production.category'));
    }

    public function render()
    {
        return view('livewire.production.category-form');
    }
}
