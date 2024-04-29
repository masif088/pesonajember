<?php

namespace App\Livewire;

use Livewire\Component;

class SellingTab extends Component
{

    public $sellingTab;
    public $activeTab="Penagihan";

    protected $listeners=['setActiveTab'=>'setActiveTab'];

    public function mount()
    {
        $this->sellingTab = [
            'Penagihan',
            'DP diterima',
            'Proses Produksi',
            'Pelunasan',
            'Pengiriman',
            'Selesai',
            'Cancel',
        ];

    }

    public function setActiveTab($tab)
    {
//        dd("asd");
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.selling-tab');
    }
}
