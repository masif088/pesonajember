<?php

namespace App\Repository\Form;

use App\Repository\Form;

class CustomerChoiceFlag implements Form
{

    protected $table = 'customers';

    public static function formRules(): array
    {
        return [
            'form.name' => 'required|max:255',
            'form.company_name' => 'nullable|max:255',
            'form.phone' => 'nullable|max:255',
            'form.email' => 'nullable',
            'form.note' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
//        $customer  = eloquent_to_options(Customer::get(), 'id','name');

        $customer= [];
        foreach (\App\Models\Customer::get() as $param) {
            $customer[]=['value'=>$param->id,'title'=>$param->company_name." - ".$param->name];
        }

        return [
            [
                'title' => 'Nama perusahaan peminjam bendera',
                'type' => 'select',
                'model' => 'customer_id',
                'options' => $customer,
                'class' => 'col-span-12',
            ],
        ];
    }
}
