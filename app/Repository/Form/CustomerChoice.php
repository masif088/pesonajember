<?php

namespace App\Repository\Form;

use App\Repository\Form;

class CustomerChoice implements Form
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
        $customer  = eloquent_to_options(Customer::get(), 'id','name');
        return [
            [
                'title' => 'Nama konsumen/perusahaan',
                'type' => 'select',
                'model' => 'customer_id',
                'options' => $customer,
                'class' => 'col-span-12',
            ],
        ];
    }
}
