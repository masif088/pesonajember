<?php

namespace App\Repository\Form;

use App\Models\Status;
use App\Repository\Form;

class Salary extends \App\Models\Salary implements Form
{
    protected $table = 'salaries';

//'user_id', '', 'bonus', '', 'transportation', '', '', ''
    public static function formRules(): array
    {
        return [
            'form.user_id' => 'required',
            'form.basic_salary' => 'required',
            'form.bonus' => 'required',
            'form.overtime' => 'required',
            'form.transportation' => 'required',
            'form.debt_deduction' => 'required',
            'form.employee_cooperative_deductions' => 'required',
            'form.reference' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

//        'form.user_id' => 'required',
//            'form.' => 'required',
//            'form.bonus' => 'required',
//            'form.overtime' => 'required',
//            'form.transportation' => 'required',
//            'form.' => 'required',
//            'form.' => 'required',
//            'form.' => 'required',
        $status = eloquent_to_options(User::get(),'id','name');
        $data = [
            [
                'title' => 'Nama Karyawan',
                'type' => 'select',
                'model' => 'user_id',
                'options' => $status,
                'required' => true,
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Referensi',
                'type' => 'text',
                'model' => 'reference',
                'required' => true,
                'class' => 'col-span-12',
            ],

            [
                'title' => 'Gaji pokok',
                'type' => 'number',
                'model' => 'basic_salary',
                'required' => true,
                'class' => 'col-span-6',
            ],[
                'title' => 'Uang Transportasi',
                'type' => 'number',
                'model' => 'transportation',
                'required' => true,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Bonus',
                'type' => 'number',
                'model' => 'bonus',
                'required' => true,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Lembur',
                'type' => 'number',
                'model' => 'overtime',
                'required' => true,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Potongan Hutang',
                'type' => 'number',
                'model' => 'debt_deduction',
                'required' => true,
                'class' => 'col-span-6',
            ],

            [
                'title' => 'Potongan Koperasi',
                'type' => 'number',
                'model' => 'employee_cooperative_deductions',
                'required' => true,
                'class' => 'col-span-6',
            ],




            [
                'title' => 'Catatan',
                'type' => 'text',
                'model' => 'note',
                'required' => true,
                'class' => 'col-span-12',
            ],

        ];

        return $data;
    }
}
