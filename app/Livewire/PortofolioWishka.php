<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class PortofolioWishka extends Component
{
    public $categories;
    public $products;
    public $active=1;

    public function mount()
    {
        foreach (ProductCategory::get() as $cat){
            $this->categories[]=['key'=>$cat->id,'value'=>$cat->title];
        }
        foreach (Product::where('product_category_id','=',1)->take(8)->get() as $cat){
            $this->products[]=$cat;
        }


    }
    public function setActive($id)
    {
        $this->active=$id;
        $this->products=[];
        foreach (Product::where('product_category_id','=',$id)->take(8)->get() as $cat){
            $this->products[]=$cat;
        }

    }
    public function render()
    {
        return view('livewire.portofolio-wishka');
    }
}
