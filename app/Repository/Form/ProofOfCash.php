<?php

namespace App\Repository\Form;

use App\Models\OrderProofOfCash;
use App\Repository\Form;
use Carbon\Carbon;

class ProofOfCash extends OrderProofOfCash implements Form
{

    protected $table = 'order_proof_of_cashes';

    public static function formRules(): array
    {
        return [
            'form.note' => 'nullable',
            'form.nominal' => 'nullable|numeric',
            'form.pic' => 'nullable|max:255',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }

    public static function getNumber($id) :string
    {
        $partner = \App\Models\Partner::find($id);
        $now  = Carbon::now();
        $count = OrderProofOfCash::where('partner_id', $partner->id)
                ->whereDate('created_at', $now)->count()+1;
        return getNumberFormat($count,$partner->format_number_proof_of_cash,$now);
    }

    public static function formField($params = null): array
    {
        return [

            [
                'title' => 'Untuk pembayaran',
                'type' => 'textarea',
                'model' => 'note',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Nominal',
                'type' => 'number',
                'model' => 'nominal',
                'class' => 'col-span-12',
            ],
            [
                'title' => 'Pemesan',
                'type' => 'text',
                'model' => 'pic',
                'class' => 'col-span-12',
            ],

        ];
    }
}
