<?php

namespace App\Livewire\Production;

use App\Models\TransactionList;
use App\Repository\Form\User;
use Livewire\Component;

class PersonInCharge extends Component
{

    public function mount()
    {
        $t= TransactionList::whereHas('transactionStatus',function ($q){
            $q->whereHas('transactionStatusAttachments', function ($q2){
                $q2->where('key','pic')->where('value',auth()->id());
            });
        })->get();
//        dd($t);
    }

    public function render()
    {
        return view('livewire.production.person-in-charge');
    }
}
