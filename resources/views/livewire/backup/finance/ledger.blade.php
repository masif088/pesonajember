@php use App\Models\AccountJournalDetail;use App\Models\AccountName;use App\Models\AccountOpeningBalance; @endphp
<div class="col-span-12 text-center">
    <h1 class="text-2xl uppercase">
        MUTASI BUKU BESAR {{ $monthName[intval($month)] }} {{ $year }}
    </h1>
    <h2 class="text-xl">
        {{ AccountName::find($accountNameId)->title??'' }}
    </h2>


    <div class="grid grid-cols-12">
        <div wire:ignore class="col-span-4 text-start">
            Kode Jurnal
            <select
                id="accountNameId"
                onchange="journal()"
                class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white select2 select3"
                multiple=""
                name=""
            >
                @foreach( $optionAccountNames as $option)
                    <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
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
        <div class="overflow-x-auto relative ">
            <table
                class="border-collapse border-wishka-400 w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded table-auto">
                <thead class=" text-md text-uppercase text-gray-700 uppercase dark:bg-dark dark:text-white text-bold">
                <tr class="border-b-[3px] border-wishka-400 border-collapse">
                    <td class="text-center" rowspan="2">No</td>
                    <td class="text-center" rowspan="2">No Bukti</td>
                    <td class="text-center" rowspan="2">Tanggal</td>
                    <td class="text-center">Keterangan</td>
                    <td class="text-center">Debet</td>
                    <td class="text-center">Kredit</td>
                    <td class="text-center">Saldo</td>
                </tr>
                <tr class="border-b-[3px] border-wishka-400 border-collapse">
                    <td class="text-center">Total</td>
                    <td class="text-end">Rp. {{ thousand_format($debit) }}</td>
                    <td class="text-end">Rp. {{ thousand_format($credit) }}</td>
                    <td class="text-end">Rp. {{ thousand_format($total) }}</td>
                </tr>
                </thead>
                <tbody>
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Saldo Awal</td>
                    <td></td>
                    <td></td>

                    <td class="text-end">Rp. {{ $opening?thousand_format($opening->opening_balances):0 }}</td>
                </tr>
                @foreach($acd as $index=>$an)

                    @php($balance+=$an->debit-$an->credit)
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="text-center">-</td>
                        <td class="text-center">{{ $an->accountJournal->journal_date }}</td>
                        <td class="text-start">{{ $an->note }}</td>
                        <td class="text-end">Rp. {{ thousand_format($an->debit) }}</td>
                        <td class="text-end">Rp. {{ thousand_format($an->credit) }}</td>
                        <td class="text-end">Rp. {{ thousand_format($balance) }}</td>

                    </tr>

                @endforeach
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
