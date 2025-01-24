<?php

namespace App\Livewire\Backup\Product;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public $dataId;
    public $product;

    public function mount()
    {
        $this->product = Product::find($this->dataId);
    }
    public function render()
    {
        return view('livewire.product.product-detail');
    }
}
