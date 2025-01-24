<?php

namespace App\Livewire\Backup;

use Livewire\Component;

class Test extends Component
{
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function change($v)
    {
        $this->count=$v;
    }

    public function render()
    {
        return view('livewire.test');
    }
}
