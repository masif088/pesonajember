<?php

namespace App\Repository\Form;

use App\Models\MaterialCategory;
use App\Models\Status;
use App\Models\Supplier;
use App\Repository\Form;

class Material extends \App\Models\Material implements Form
{
    protected $table = 'materials';

    public static function formRules(): array
    {

        return [
            'form.title' => 'required|max:255',
            'form.code' => 'required|max:255',
            'form.minimal_stock' => 'nullable|numeric',
            'form.stock' => 'nullable|numeric',
            'form.value' => 'nullable|numeric',
            'form.unit' => 'required',
            'form.supplier_id' => 'required',
            'form.status_id' => 'required',
            'form.material_category_id' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
        $status = eloquent_to_options(Status::get());
        $supplier = eloquent_to_options(Supplier::get());
        $category = eloquent_to_options(MaterialCategory::get());

        if ($params == 'create') {
            return [
                [
                    'title' => 'Nama barang/material/bahan',
                    'type' => 'text',
                    'model' => 'title',
                    'required' => true,
                    'class' => 'col-span-6',
                ],
                [
                    'title' => 'Code barang/material/bahan',
                    'type' => 'text',
                    'model' => 'code',
                    'required' => true,
                    'class' => 'col-span-6',
                ],
                [
                    'title' => 'Stock',
                    'type' => 'number',
                    'model' => 'stock',
                    'required' => true,
                    'class' => 'col-span-6',
                    'live'=>true,
                ],
                [
                    'title' => 'Batas ambang bawah Stock',
                    'type' => 'number',
                    'model' => 'minimum_stock',
                    'required' => true,
                    'class' => 'col-span-6',
                ],
                [
                    'title' => 'Satuan',
                    'type' => 'text',
                    'model' => 'unit',
                    'required' => true,
                    'class' => 'col-span-6',
                    'placeholder' => 'satuan penggunaan dalam produksi',
                ],
                [
                    'title' => 'Harga beli keseluruhan',
                    'type' => 'number',
                    'model' => 'value',
                    'required' => true,
                    'class' => 'col-span-6',
                    'live'=>true,
                ],
                [
                    'title' => 'Supplier',
                    'type' => 'select',
                    'model' => 'supplier_id',
                    'required' => true,
                    'class' => 'col-span-6',
                    'options' => $supplier,
                ],
                [
                    'title' => 'Material Category',
                    'type' => 'select',
                    'model' => 'material_category_id',
                    'options' => $category,
                    'required' => true,
                    'class' => 'col-span-6',
                ],
                [
                    'title' => 'Status',
                    'type' => 'select',
                    'model' => 'status_id',
                    'options' => $status,
                    'required' => true,
                    'class' => 'col-span-6',
                ],
            ];
        } else {
            return [
                [
                    'title' => 'Nama barang/material/bahan',
                    'type' => 'text',
                    'model' => 'title',
                    'required' => true,
                    'class' => 'col-span-6',
                ],
                [
                    'title' => 'Code barang/material/bahan',
                    'type' => 'text',
                    'model' => 'code',
                    'required' => true,
                    'class' => 'col-span-6',
                ],
                [
                    'title' => 'Batas ambang bawah Stock',
                    'type' => 'number',
                    'model' => 'minimum_stock',
                    'required' => true,
                    'class' => 'col-span-6',
                ],
                [
                    'title' => 'Satuan',
                    'type' => 'text',
                    'model' => 'unit',
                    'required' => true,
                    'class' => 'col-span-6',
                    'placeholder' => 'satuan penggunaan dalam produksi',
                ],
                [
                    'title' => 'Supplier',
                    'type' => 'select',
                    'model' => 'supplier_id',
                    'required' => true,
                    'class' => 'col-span-6',
                    'options' => $supplier,
                ],
                [
                    'title' => 'Material Category',
                    'type' => 'select',
                    'model' => 'material_category_id',
                    'options' => $category,
                    'required' => true,
                    'class' => 'col-span-6',
                ],
                [
                    'title' => 'Status',
                    'type' => 'select',
                    'model' => 'status_id',
                    'options' => $status,
                    'required' => true,
                    'class' => 'col-span-6',
                ],
            ];
        }
    }
}
