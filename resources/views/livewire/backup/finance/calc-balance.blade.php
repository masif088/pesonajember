@php use App\Models\AccountGroup;use App\Models\AccountJournalDetail;use App\Models\AccountName;use App\Models\AccountOpeningBalance; @endphp
<div class="col-span-12 text-center">
    <h1 class="text-2xl uppercase text-center">
        Catatan atas Laporan Keuangan Untuk Periode {{ $monthName[intval($month)-1] }} {{ $year }}
    </h1>


    <br><br>
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $monthName[intval($month)-1] }} {{ $year }}</td>

                    <td>{{ $monthName[intval($month2)-1] }} {{ $year2 }}</td>
                </tr>

                </thead>
                <tbody>



                @php($count=1)
                @foreach(AccountGroup::where('account_type_id','=',1)->get() as $index=>$ag)
                    @foreach($ag->accountCategories as $ac)
                        <tr class=" dark:text-white text-black border-b border-gray-200 ">
                            <td class="text-start">{{ numberToRomanRepresentation($count) }}</td>
                            <td colspan="2">{{ $ac->title }}, terdiri dari :</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @php($tac=0)
                        @php($tac2=0)
                        @foreach($ac->accountNames as $an)

                            <tr class=" dark:text-white text-black border-b border-gray-200 ">
                                @php($acb =AccountOpeningBalance::where('account_name_id','=',$an->id)->where('month','=',$month)->where('year','=',$year)->first())
                                @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){
                                        $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                                    })->get())
                                @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))
                                @php($tac+=$ns)


                                @php($acb2 =AccountOpeningBalance::where('account_name_id','=',$an->id)->where('month','=',$month2)->where('year','=',$year2)->first())
                                @php($acd2 = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month2,$year2){
                                        $q->whereMonth('journal_date','=',$month2)->whereYear('journal_date','=',$year2);
                                    })->get())
                                @php($ns2 = ($acb2->opening_balances??0) + $acd2->sum('debit') - $acd2->sum('credit'))
                                @php($tac2+=$ns2)

                                <td></td>
                                <td></td>
                                <td>{{ $an->title }}</td>
                                <td>Rp. {{ thousand_format($ns) }}</td>
                                <td>Rp. {{ thousand_format($ns2) }}</td>
                            </tr>
                        @endforeach
                        <tr class=" dark:text-white text-black border-b border-gray-200 ">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><b>Rp. {{ thousand_format($tac) }}</b></td>
                            <td><b>Rp. {{ thousand_format($tac2) }}</b></td>
                        </tr>
                        @php($count+=1)
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


</div>
