@php use App\Models\AccountGroup;use App\Models\AccountJournalDetail;use App\Models\AccountName;use App\Models\AccountOpeningBalance; @endphp
<div class="col-span-12 text-center">
    <h1 class="text-2xl uppercase">
        MUTASI BUKU BESAR {{ $monthName[intval($month)] }} {{ $year }}
    </h1>
    <br>
    <div class="grid w-full grid-cols-12 bg-wishka-200 rounded-2xl p-2">
        <div class="col-span-2 text-start">
            <i class="ti ti-chevron-left text-2xl p-2" wire:click="decrementMonth"></i>
        </div>
        <div class="col-span-8 text-center align-middle" style="display: table">
            <div class="table-cell align-middle text-lg"><b>Bulan {{ $monthName[$month-1] }} {{ $year }}</b></div>
        </div>
        <div class="col-span-2 text-end">
            <i class="ti ti-chevron-right text-2xl p-2" wire:click="incrementMonth"></i>
        </div>
    </div>
    <br><br>
    <div class="grid grid-cols-12">
        <div class="col-span-3 text-start">
            Saldo Normal : {{ AccountName::find($accountNameId)->level??'' }}
        </div>
    </div>
    @php
        $opening =AccountOpeningBalance::where('account_name_id','=',$accountNameId)
->where('month','=',$month)->where('year','=',$year)->first();
        $total=$opening?$opening->opening_balances:0;
        $balance = $opening?$opening->opening_balances:0;
        $acd = AccountJournalDetail::where('account_name_id','=',$accountNameId)
->whereHas('accountJournal',function ($q) use($month,$year){
    $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
})->get();
    @endphp


    @foreach($acd as $index=>$an)
        @php
            $opening =AccountOpeningBalance::where('account_name_id','=',$accountNameId)
->where('month','=',$month)->where('year','=',$year)->first();
            $debit+=$an->debit;
            $credit+=$an->credit;
            $total+=$an->debit-$an->credit;
        @endphp
    @endforeach


    <div class="grid grid-cols-1 gap-3 p-4 lg:grid-cols-1 xl:grid-cols-1">
        <div class="overflow-x-auto ">
            <table style="width: 100%"
                   class=" table border-collapse border-wishka-400 text-sm text-left text-gray-500 dark:text-gray-400 rounded table-auto">
                <thead class=" text-md text-uppercase text-gray-700 uppercase dark:bg-dark dark:text-white text-bold">
                <tr class="border-b-[3px] border-wishka-400 border-collapse">
                    <td style="width: 200px !important;" class="text-start" rowspan="2"> NO PERK</td>
                    <td style="width: 400px  !important;" class="text-center" rowspan="2"> #N/A</td>
                    <td class="text-center" colspan="2">SALDO AWAL</td>
                    <td class="text-center" colspan="2">MUTASI</td>
                    <td class="text-center" colspan="2">NERACA SALDO</td>
                    <td class="text-center" colspan="2">LABA RUGI</td>
                    <td class="text-center" colspan="2">NERACA AKHIR</td>
                </tr>
                <tr class="border-b-[3px] border-wishka-400 border-collapse">
                    <td class="text-center">DEBET</td>
                    <td class="text-center">KREDIT</td>

                    <td class="text-center">DEBET</td>
                    <td class="text-center">KREDIT</td>

                    <td class="text-center">DEBET</td>
                    <td class="text-center">KREDIT</td>

                    <td class="text-center">DEBET</td>
                    <td class="text-center">KREDIT</td>

                    <td class="text-center">DEBET</td>
                    <td class="text-center">KREDIT</td>

                </tr>
                </thead>
                <tbody>

                @php

                    $tsad=0;
                    $tsac=0;
                    $md =0;
                    $mc =0;
                    $nsd =0;
                    $nsc =0;
                    $lrd =0;
                    $lrc =0;
                    $nad =0;
                    $nac =0;


                @endphp

                @foreach(AccountGroup::get() as $index=>$ag)
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        <td class="text-start">{{ $ag->code }}</td>
                        <td>{{ $ag->title }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($ag->accountCategories as $ac)
                        <tr class=" dark:text-white text-black border-b border-gray-200 ">
                            <td class="text-start">{{ $ac->code }}</td>
                            <td>{{ $ac->title }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($ac->accountNames as $an)
                            @php
                                $acb =AccountOpeningBalance::where('account_name_id','=',$an->id)->where('month','=',$month)->where('year','=',$year)->first();
                                $acd = AccountJournalDetail::where('account_name_id','=',$an->id)
->whereHas('accountJournal',function ($q) use($month,$year){
    $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
})->get();
                                $ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit');


                                if ($ns>0){
                                    $nsd+=$ns;
                                    if ($ag->account_type_id ==2){
                                        $lrd+=$ns;
                                    }else{
                                        $nad+=$ns;
                                    }
                                }elseif($ns<0){
                                    $nsc+=$ns;
                                    if ($ag->account_type_id ==2){
                                        $lrc+=$ns;
                                    }else{
                                        $nac+=$ns;
                                    }
                                }
                                if ($acb!=null){
                                    if ($acb->opening_balances>0){
                                    $tsad+=$acb->opening_balances;
                                }elseif($acb->opening_balances<0){
                                    $tsac+=$acb->opening_balances;
                                }
                                }



                            @endphp
                            <tr class=" dark:text-white text-black border-b border-gray-200 ">
                                <td class="text-start">{{ $an->code }}</td>
                                <td>{{ $an->title }}</td>
                                <td style="width: 150px" class="text-end">
                                    @if($acb!=null)
                                        {{ $acb->opening_balances>0? thousand_format($acb->opening_balances): '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td style="width: 150px" class="text-end">@if($acb!=null)
                                        @php($tsac+=($acb->opening_balances<0))
                                        {{ $acb->opening_balances<0? thousand_format(abs($acb->opening_balances)): '-' }}
                                    @else
                                        -
                                    @endif</td>
                                <td style="width: 150px" class="text-end">
                                    @php($md+=$acd->sum('debit'))
                                    {{ $acd->sum('debit')?thousand_format($acd->sum('debit')):'-' }}
                                </td>
                                <td style="width: 150px" class="text-end">
                                    @php($mc+=$acd->sum('credit'))
                                    {{ $acd->sum('credit')?thousand_format($acd->sum('credit')):'-' }}</td>
                                <td style="width: 150px" class="text-end">

                                    {{ $ns>0? thousand_format($ns):'-' }}
                                </td>
                                <td style="width: 150px" class="text-end">
                                    {{ $ns<0? thousand_format(abs($ns)):'-' }}
                                </td>
                                <td style="width: 150px" class="text-end">
                                    @if($ag->account_type_id ==2)
                                        {{ $ns>0? thousand_format($ns):'-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td style="width: 150px" class="text-end">
                                    @if($ag->account_type_id ==2)
                                        {{ $ns<0? thousand_format(abs($ns)):'-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td style="width: 150px" class="text-end">
                                    @if($ag->account_type_id ==1)
                                        {{ $ns>0? thousand_format($ns):'-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td style="width: 150px" class="text-end">
                                    @if($ag->account_type_id ==1)
                                        {{ $ns<0? thousand_format(abs($ns)):'-' }}
                                    @else
                                        -
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    @endforeach
                @endforeach
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td colspan="12"> &nbsp;</td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td></td>
                    <td class="text-end">{{ thousand_format($tsad) }}</td>
                    <td class="text-end">{{ thousand_format(abs($tsad)) }}</td>
                    <td class="text-end">{{ thousand_format($md) }}</td>
                    <td class="text-end">{{ thousand_format(abs($mc)) }}</td>
                    <td class="text-end">{{ thousand_format($nsd) }}</td>
                    <td class="text-end">{{ thousand_format(abs($nsc)) }}</td>
                    <td class="text-end">{{ thousand_format($lrd) }}</td>
                    <td class="text-end">{{ thousand_format(abs($lrc)) }}</td>
                    <td class="text-end">{{ thousand_format($nad) }}</td>
                    <td class="text-end">{{ thousand_format(abs($nac)) }}</td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 font-bold">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-end">{{ thousand_format(abs($lrc)-$lrd) }}</td>
                    <td></td>
                    <td></td>
                    <td class="text-end">{{ thousand_format($nad-abs($nac)) }}</td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 font-bold">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-end">{{ thousand_format(abs($lrc)-$lrd+$lrd) }}</td>
                    <td class="text-end">{{ thousand_format(abs($lrc)) }}</td>
                    <td class="text-end">{{ thousand_format($nad) }}</td>
                    <td class="text-end">{{ thousand_format($nad-abs($nac)+abs($nac)) }}</td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 font-bold">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-end">{{ thousand_format($nad-abs($nac)+abs($nac) - abs($lrc)-$lrd+$lrd) }}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>


    <script>
        document.addEventListener('select2dispatch', function () {
            setTimeout(function () {
                $('.select3').select2({
                    maximumSelectionLength: 1
                });
            }, 10);
        });

        function journal() {
            @this.
            set(`accountNameId`, $(`#accountNameId`).val()[0]);
        }
    </script>
</div>
