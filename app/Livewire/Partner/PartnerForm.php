<?php

namespace App\Livewire\Partner;

use App\Repository\Form\Partner as model;
use Illuminate\Support\Str;
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
        if ($this->form['kop_image'] != null) {
            $kop = $this->form['kop_image'];
            $this->form['kop'] = $kop->storeAs('kop-image', $kop->getClientOriginalName());
            unset($this->form['kop_image']);
        }
        if ($this->form['logo_image'] != null) {
            $logo = $this->form['logo_image'];
            $this->form['logo'] = $kop->storeAs('logo-image', $logo->getClientOriginalName());
            unset($this->form['logo_image']);
        }


        $this->validate();
        $this->resetErrorBag();
        model::create($this->form);
        $this->redirect(route($this->indexPath));
    }

    public function update()
    {
        if ($this->form['kop_image'] != null) {
            $kop = $this->form['kop_image'];
            $filename = Str::slug($this->form['name'].$kop->getClientOriginalExtension());
            $kop->storeAs('public/kop-image', $filename);
            $this->form['kop'] = 'kop-image/'.$filename;
            unset($this->form['kop_image']);
        }
        if ($this->form['logo_image'] != null) {
            $logo = $this->form['logo_image'];
            $filename = Str::slug($this->form['name'].$logo->getClientOriginalExtension());
            $logo->storeAs('public/logo', $filename);
            $this->form['logo'] = 'logo/'.$filename;
            unset($this->form['logo_image']);
        }
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
