<?php

namespace App\Livewire\Table;

use App\Models\CompanyAssetDecreaseValue;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionStatusAttachment;
use Carbon\Carbon;

class CompanyAsset extends Master
{
    public function shrinkageNow($id)
    {

        $companyAsset = \App\Models\CompanyAsset::find($id);
        $now = Carbon::now();

        $cadv = CompanyAssetDecreaseValue::where('company_asset_id','=',$id)->where('year',$now->year)->where('month',$now->month)->first();

        if ($cadv==null) {
            $companyAsset->update([
                'value_now' => $companyAsset->value_now - $companyAsset->last_shrinkage,
                'last_shrinkage' => $companyAsset->last_shrinkage,
            ]);

            CompanyAssetDecreaseValue::create([
                'company_asset_id' => $companyAsset->id,
                'shrinkage' => $companyAsset->last_shrinkage,
                'month' => $now->month,
                'year' => $now->year,
            ]);
        }


        $this->dispatch('reRender');

    }

    public function changeMockupStatus($id, $status)
    {
        TransactionStatusAttachment::find($id)->update([
            'value' => $status,
        ]);
        $this->dispatch('reRender');
    }
}
