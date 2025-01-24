<?php

namespace App\Repository\FormBackup;

use App\Models\CooperativeCreditEmployeePay;
use App\Repository\FormBackup;

class CreditEmployee extends CooperativeCreditEmployeePay implements Form
{
    protected $table = 'cooperative_credit_employee_details';

    public static function formRules(): array
    {
        //        'title', 'date_transaction', 'debit', 'credit', 'cooperative_credit_employee_id'
        return [
            'form.title' => 'required',
            'form.date_transaction' => 'required',
            'form.debit' => 'required',
            'form.credit' => 'nullable',
            'form.cooperative_credit_employee_id' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {
        //        'title', 'date_transaction', 'debit', 'credit', 'cooperative_credit_employee_id'
        $users = eloquent_to_options(\App\Models\User::get(),'id','name');

        return [
            [
                'title' => 'Nama Karyawan',
                'type' => 'select',
                'model' => 'cooperative_credit_employee_id',
                'options' => $users,
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Uraian',
                'type' => 'string',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Tanggal transaksi',
                'type' => 'date',
                'model' => 'date_transaction',
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Debet',
                'type' => 'number',
                'model' => 'debit',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Kredit',
                'type' => 'number',
                'model' => 'credit',
                'required' => true,
                'class' => 'col-span-6',
            ],
        ];

        return $data;
    }
}
