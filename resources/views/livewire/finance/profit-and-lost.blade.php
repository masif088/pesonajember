@php use App\Models\AccountGroup;use App\Models\AccountJournalDetail;use App\Models\AccountName;use App\Models\AccountOpeningBalance; @endphp
<div class="col-span-12 text-center">
    <h1 class="text-2xl uppercase">
        Catatan atas Laporan Keuangan
        Untuk Periode {{ $monthName[intval($month)-1] }} {{ $year }}
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
                    <td>Ref</td>
                    <td>{{ $monthName[intval($month)-1] }} {{ $year }}</td>
                </tr>

                </thead>
                <tbody>



                @php($count=17)
                @php($parent = 'PENDAPATAN')
                @php($total=0)
                @foreach(AccountGroup::where('account_type_id','=',2)->get() as $index=>$ag)
                    @if($parent!=$ag->parent)
                        <tr class=" dark:text-white text-black border-b border-gray-200 ">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class=" dark:text-white text-black border-b border-gray-200 ">

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Rp. {{ thousand_format($total) }}</b></td>
                        </tr>
                        <tr class=" dark:text-white text-black border-b border-gray-200 ">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php($parent=$ag->parent)
                        @php($total=0)
                    @endif
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        <td class="text-start">{{ $ag->code }}</td>
                        <td colspan="2">{{ $ag->title }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @php($tag=0)
                    @foreach($ag->accountCategories as $ac)
                        @php($tac=0)
                        @foreach($ac->accountNames as $an)
                            @php($acb =AccountOpeningBalance::where('account_name_id','=',$an->id)->where('month','=',$month)->where('year','=',$year)->first())
                            @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){
                                    $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                                })->get())
                            @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))
                            @php($tac+=$ns)
                            @php($tag+=$ns)
                            @php($total+=$ns)
                        @endforeach
                        <tr class=" dark:text-white text-black border-b border-gray-200 ">
                            <td class="text-start">{{ $ac->code }}</td>
                            <td colspan="2">{{ $ac->title }}</td>
                            <td>{{ numberToRomanRepresentation($count) }}</td>
                            <td>Rp. {{ thousand_format($tac) }}</td>
                        </tr>
                        @php($count+=1)
                    @endforeach
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        <td class="text-start"></td>
                        <td colspan="2"></td>
                        <td></td>
                        <td><b>Rp. {{ thousand_format($tag) }}</b></td>
                    </tr>
                @endforeach
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 ">

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Rp. {{ thousand_format($total) }}</b></td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>


</div>
