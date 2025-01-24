<?php

namespace App\Livewire\Backup\Transaction;

use Livewire\Component;

class Production extends Component
{
    public $sellingTab;

    public $activeTab = 'Potong';

    protected $listeners = ['setActiveTab' => 'setActiveTab'];

    public function mount()
    {
        $this->sellingTab = [
            'Potong',
            'Print',
            'Pasang-Label',
            'Jahit',
            'Quality-Control',
            'Packing',
            'Selesai'
        ];
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.transaction.production');
    }
}
