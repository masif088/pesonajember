<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Livewire\Component;

class MaterialData extends Component
{
    public $dataId;
    public $material;
    public function mount()
    {
        $this->material = Material::find($this->dataId);
        if ($this->material==null){
            $this->redirect(route('material.index'));
        }
    }
    public function render()
    {
        return view('livewire.material.material-data');
    }
}
