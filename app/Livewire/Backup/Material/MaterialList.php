<?php

namespace App\Livewire\Backup\Material;

use App\Models\MaterialCategory;
use Livewire\Component;

class MaterialList extends Component
{
    public $categories;
    public function mount()
    {
        $this->categories = MaterialCategory::get();
    }
    public function render()
    {
        return view('livewire.material.material-list');
    }
}
