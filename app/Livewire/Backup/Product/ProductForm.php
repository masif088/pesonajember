<?php

namespace App\Livewire\Backup\Product;

use App\Models\AccountName;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductAdditionalCost;
use App\Models\ProductCategory;
use App\Models\ProductMaterial;
use App\Models\ProductProcesses;
use App\Models\ProductProcessTags;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public $form;
    public $action='create';

    public $dataId;

    public $thumbnail;

    public $materialCount = 1;

    public $costCount = 1;

    public $materialList = [
        ['material_id' => null, 'amount' => 0, 'size' => 0, 'note' => ''],
    ];

    public $optionMaterial;

    public $listMaterial;

    public $listCost;

    public $listMaterialUnit;

    public $costList = [
        ['account_name_id' => null, 'amount' => 0, 'price' => 0, 'note' => ''],
    ];

    public $optionCategory;

    public $optionTags;

    public $material;

    public $tagsSelected=[];

    public function mount()
    {
        $this->form = [
            'code' => '',
            'title' => '',
            'size' => '',
            'stock' => 0,
            'price' => 0,
            'custom_status' => 1,
            'note' => '',
            'product_category_id' => null,
            'status_id' => '1',
            'display_status' => 0,
        ];
        $material = Material::get();

        $this->optionCategory = eloquent_to_options(ProductCategory::get());
        $this->optionTags = eloquent_to_options(ProductProcessTags::get());
        $this->optionMaterial = [];

        $this->listMaterial = [];
        $this->listMaterialUnit = [];
        foreach ($material as $m) {
            $this->optionMaterial[] = ['value' => $m->id, 'title' => $m->materialCategory->title.' - '.$m->title];
            if ($m->stock == 0) {
                $this->listMaterial[$m->id] = 0;
            } else {
                $this->listMaterial[$m->id] = $m->value / $m->stock;
            }
            $this->listMaterialUnit[$m->id] = $m->unit;
        }
        $this->listCost = [];
        foreach (AccountName::where('additional_cost', '=', 1)->get() as $item) {
            $this->listCost[] = ['value' => $item->id, 'title' => $item->code.' - '.$item->title];
        }

        $this->dispatch('select2dispatch');
        if ($this->dataId != null) {
            $data = Product::find($this->dataId);
            $this->form = [
                'code' => $data->code,
                'title' => $data->title,
                'price' => $data->price,
                'size' => $data->size,
                'stock' => $data->stock,
                'custom_status' => $data->custom_status,
                'note' => $data->note,
                'product_category_id' => $data->product_category_id,
                'status_id' => $data->status_id,
                'display_status' => $data->display_status,
            ];
            $this->tagsSelected = $data->productProcesses->pluck('product_process_tag_id')->toArray();

            if ($data->productMaterials != null) {
                $this->materialList = [];
                $this->materialCount=0;
                foreach ($data->productMaterials as $productMaterial) {
                    $this->materialList[] = [
                        'size' => $productMaterial->size,
                        'amount' => $productMaterial->amount,
                        'note' => $productMaterial->note,
                        'material_id' => [$productMaterial->material_id],
                    ];
                    $this->materialCount++;
                }
            }
            if ($data->productMaterials != null) {
                $this->materialList = [];
                $this->materialCount=0;
                foreach ($data->productMaterials as $productMaterial) {
                    $this->materialList[] = [
                        'size' => $productMaterial->size,
                        'amount' => $productMaterial->amount,
                        'note' => $productMaterial->note,
                        'material_id' => [$productMaterial->material_id],
                    ];
                    $this->materialCount++;
                }
            }
            if ($data->productAdditionalCosts != null) {
                $this->costList = [];
                $this->costCount = 0;
                foreach ($data->productAdditionalCosts as $productMaterial) {
                    $this->costList[] = [
                        'price' => $productMaterial->price,
                        'amount' => $productMaterial->amount,
                        'note' => $productMaterial->note,
                        'account_name_id' => [$productMaterial->account_name_id],
                    ];
                    $this->costCount++;
                }
            }
            $this->dispatch('select2dispatch');
        }
    }

    public function getRules()
    {
        return [
            'form.code' => 'required|max:255',
            'form.title' => 'required|max:255',
            'form.size' => 'required|max:255',
            'form.custom_status' => 'required',
            'form.note' => 'nullable',
            'form.product_category_id' => 'required',
            'form.status_id' => 'required',
            'form.display_status' => 'required',
        ];
    }

    public function addMaterialCount()
    {
        $this->materialCount++;
        $this->materialList[] = ['material_id' => null, 'amount' => 0, 'size' => 0, 'note' => ''];
        $this->dispatch('select2dispatch');
    }

    public function addCostCount()
    {
        $this->costCount++;
        $this->costList[] = ['account_name_id' => null, 'amount' => 0, 'price' => 0];
        $this->dispatch('select2dispatch');
    }

    public function create()
    {
        $this->validate();

        if ($this->thumbnail != null) {
            $this->form['photo_product'] = $this->thumbnail->store(path: 'public/photos');
        }
        $product = Product::create($this->form);
        foreach ($this->tagsSelected as $tag) {
            ProductProcesses::create([
                'product_id' => $product->id,
                'product_process_tag_id' => $tag,
            ]);
        }
        foreach ($this->materialList as $list) {
            if ($list['material_id'] != null or $list['material_id'] != []) {
                ProductMaterial::create([
                    'product_id' => $product->id,
                    'size' => $list['size'],
                    'amount' => $list['amount'],
                    'note' => $list['note'],
                    'material_id' => $list['material_id'][0],
                ]);
            }
        }
        foreach ($this->costList as $list) {
            if ($list['account_name_id'] != null or $list['account_name_id'] != []) {
                ProductAdditionalCost::create([
                    'product_id' => $product->id,
                    'price' => $list['price'],
                    'amount' => $list['amount'],
                    'note' => $list['note'],
                    'account_name_id' => $list['account_name_id'][0],
                ]);
            }
        }
        $this->redirect(route('production.index'));
    }

    public function update()
    {
        $this->validate();

        if ($this->thumbnail != null) {
            $this->form['photo_product'] = $this->thumbnail->store(path: 'public/photos');
        }
        $product = Product::find($this->dataId);
        $product->update($this->form);
        $product->productProcesses()->delete();
        foreach ($this->tagsSelected as $tag) {
            ProductProcesses::create([
                'product_id' => $product->id,
                'product_process_tag_id' => $tag,
            ]);
        }
        $product->productMaterials()->delete();
        foreach ($this->materialList as $list) {
            if ($list['material_id'] != null or $list['material_id'] != []) {
                ProductMaterial::create([
                    'product_id' => $product->id,
                    'size' => $list['size'],
                    'amount' => $list['amount'],
                    'note' => $list['note'],
                    'material_id' => $list['material_id'][0],
                ]);
            }
        }
        $product->productAdditionalCosts()->delete();
        foreach ($this->costList as $list) {
            if ($list['account_name_id'] != null or $list['account_name_id'] != []) {
                ProductAdditionalCost::create([
                    'product_id' => $product->id,
                    'price' => $list['price'],
                    'amount' => $list['amount'],
                    'note' => $list['note'],
                    'account_name_id' => $list['account_name_id'][0],
                ]);
            }
        }
        $this->redirect(route('production.index'));
    }

    public function render()
    {
        return view('livewire.product.product-form');
    }
}
