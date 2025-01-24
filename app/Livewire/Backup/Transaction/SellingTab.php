<?php

namespace App\Livewire\Backup\Transaction;

use Livewire\Component;

class SellingTab extends Component
{

    public $sellingTab;
    public $activeTab = "Penagihan";

    protected $listeners = ['setActiveTab' => 'setActiveTab'];

    public function mount()
    {
        $this->sellingTab = [
            'Penagihan',
            'DP-diterima',
            'Mockup',
            'Proses-Produksi',
            'Pengiriman',
            'Selesai',
            'Cancel',
        ];
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.transaction.selling-tab');
    }
}
