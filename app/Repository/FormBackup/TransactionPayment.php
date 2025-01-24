<?php

namespace App\Repository\FormBackup;

use App\Models\Status;
use App\Repository\FormBackup;

class TransactionPayment extends \App\Models\TransactionPayment implements Form
{
    protected $table = 'transaction_payments';

    public static function formRules(): array
    {
        return [
            'form.transaction_id' => 'required',
            'form.bank_id' => 'required',
//            'form.payment_status_id' => 'required',
            'form.title' => 'required',
            'form.payment_at' => 'required',
            'form.schema' => 'nullable',
            'form.amount' => 'numeric',
            'form.note' => 'nullable',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function formField($params = null): array
    {

//        'form.transaction_id' => 'required',
//            'form.bank_id' => 'required',
//            'form.payment_status_id' => 'required',
//            'form.title' => 'required',
//            'form.payment_at' => 'required',
//            'form.schema' => 'nullable',
//            'form.amount' => 'numeric',
//            'form.amount_confirmation' => 'numeric',
//            'form.note' => 'nullable',
        $status = eloquent_to_options(Status::get());
        $paymentStatus = eloquent_to_options(\App\Models\PaymentStatus::get());
        $bank = eloquent_to_options(\App\Models\Bank::get(), 'id', 'bank_name');
        $data = [
            [
                'title' => 'Nama Bank',
                'type' => 'select',
                'options' => $bank,
                'model' => 'bank_id',
                'required' => true,
                'class' => 'col-span-6',
            ],
//            [
//                'title' => 'Status',
//                'type' => 'select',
//                'model' => 'payment_status_id',
//                'options' => $paymentStatus,
//                'required' => false,
//                'class' => 'col-span-6',
//            ],
            [
                'title' => 'Keterangan',
                'type' => 'text',
                'model' => 'title',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Tanggal Pembayaran',
                'type' => 'date',
                'model' => 'payment_at',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Jumlah uang',
                'type' => 'number',
                'model' => 'amount',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Skema',
                'type' => 'text',
                'model' => 'schema',
                'required' => true,
                'class' => 'col-span-6',
            ],
            [
                'title' => 'Catatan',
                'type' => 'textarea',
                'model' => 'note',
                'placeholder' => '',
                'class' => 'col-span-12',
            ],
        ];

        return $data;
    }
}
