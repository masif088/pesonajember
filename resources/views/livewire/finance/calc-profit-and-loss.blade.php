@php use App\Models\AccountCategory;use App\Models\AccountGroup;use App\Models\AccountJournalDetail;use App\Models\AccountName;use App\Models\AccountOpeningBalance; @endphp
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
                    <td>{{ $monthName[intval($month)-1] }} {{ $year }}</td>
                </tr>

                </thead>
                <tbody>

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td class="text-start">{{ numberToRomanRepresentation(17) }}</td>
                    <td colspan="2">Pendapatan Tas, terdiri dari :</td>
                    <td></td>
                    <td></td>
                </tr>

                @php($tac=0)
                @php($tag=0)
                @foreach(AccountName::where('account_category_id','=',17)->get() as $an)
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        @php($acb =AccountOpeningBalance::where('account_name_id','=',$an->id)->where('month','=',$month)->where('year','=',$year)->first())
                        @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){
                                $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                            })->get())
                        @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))
                        @php($tac+=$ns)
                        <td></td>
                        <td></td>
                        <td>{{ $an->title }}</td>
                        <td>
                            Rp. {{ thousand_format($ns) }}
                        </td>
                    </tr>
                @endforeach


                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"><b>Total Penjualan Bersih</b></td>
                    @php($tag+=$tac)
                    <td><b>Rp. {{ thousand_format($tac) }}</b></td>
                </tr>

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td class="text-start">{{ numberToRomanRepresentation(19) }}</td>
                    <td colspan="2">Harga Pokok Penjualan:</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td></td>
                    <td><b>Persed. Bahan Baku</b></td>
                    <td></td>
                    <td></td>
                </tr>

                @php($tac=0)
                @php($tag=0)
                @for($i=12;$i<15;$i++)
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        @php($acb =AccountOpeningBalance::where('account_name_id','=',$i)->where('month','=',$month)->where('year','=',$year)->first())
                        {{--                    @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){--}}
                        {{--                            $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);--}}
                        {{--                        })->get())--}}
                        @php($ns = ($acb->opening_balances??0))
                        @php($tac+=$ns)
                        <td></td>
                        <td></td>
                        <td>{{ AccountName::find($i)->title }}</td>
                        <td>
                            Rp. {{ thousand_format($ns) }}
                        </td>
                    </tr>
                @endfor

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"><b></b></td>
                    @php($tag+=$tac)
                    <td><b>Rp. {{ thousand_format($tac) }}</b></td>
                </tr>


                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td></td>
                    <td><b>Pembelian</b></td>
                    <td></td>
                    <td></td>
                </tr>

                @php($tac=0)
                @for($i=12;$i<15;$i++)
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        {{--                        @php($acb =AccountOpeningBalance::where('account_name_id','=',$i)->where('month','=',$month)->where('year','=',$year)->first())--}}
                        @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){
                                $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                            })->get())
                        @php($ns =$acd->sum('debit') - $acd->sum('credit'))
                        @php($tac+=$ns)
                        <td></td>
                        <td></td>
                        <td>{{ AccountName::find($i)->title }}</td>
                        <td>
                            Rp. {{ thousand_format($ns) }}
                        </td>
                    </tr>
                @endfor

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"><b></b></td>
                    @php($tag+=$tac)
                    <td><b>Rp. {{ thousand_format($tac) }}</b></td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"><b></b></td>
                    <td><b>Rp. {{ thousand_format($tag) }}</b></td>
                </tr>

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td colspan="5">&nbsp;</td>
                </tr>


                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td></td>
                    <td><b>Persed. Akhir Bahan Baku</b></td>
                    <td></td>
                    <td></td>
                </tr>

                @php($tac=0)
                @for($i=12;$i<15;$i++)
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        @php($acb =AccountOpeningBalance::where('account_name_id','=',$i)->where('month','=',$month)->where('year','=',$year)->first())
                        @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){
                                $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                            })->get())
                        @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))
                        @php($tac+=$ns)
                        <td></td>
                        <td></td>
                        <td>{{ AccountName::find($i)->title }}</td>
                        <td>
                            Rp. {{ thousand_format($ns) }}
                        </td>
                    </tr>
                @endfor
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"><b></b></td>
                    <td><b>Rp. {{ thousand_format($tac) }}</b></td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td colspan="5">&nbsp;</td>
                </tr>

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"><b>Beban Pokok Penjualan</b></td>
                    <td><b>Rp. {{ thousand_format($tag) }}</b></td>
                </tr>


                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td colspan="5">&nbsp;</td>
                </tr>
                @php($tag=0)

                @for($i=19;$i<21;$i++)
                    @php($accountCat=AccountCategory::find($i))
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        <td class="text-start">{{ numberToRomanRepresentation($i+1) }}</td>
                        <td colspan="2"><b>{{ $accountCat->title }}</b></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @php($tac=0)

                    @foreach(AccountName::where('account_category_id','=',$i)->get() as $an)
                        <tr class=" dark:text-white text-black border-b border-gray-200 ">
                            @php($acb =AccountOpeningBalance::where('account_name_id','=',$an->id)->where('month','=',$month)->where('year','=',$year)->first())
                            @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){
                                    $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                                })->get())
                            @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))
                            @php($tac+=$ns)
                            <td></td>
                            <td></td>
                            <td>{{ $an->title }}</td>
                            <td>
                                Rp. {{ thousand_format($ns) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        <td></td>
                        <td colspan="2"><b></b></td>
                        <td><b>Rp. {{ thousand_format($tac) }}</b></td>
                    </tr>

                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        <td colspan="5">&nbsp;</td>
                    </tr>
                @endfor



                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td class="text-start">{{ numberToRomanRepresentation(22) }}</td>
                    <td colspan="2"><b>Pendapatan (Beban) Lainnya, Terdiri atas:</b></td>
                    <td></td>
                    <td></td>
                </tr>

                @php($tac=0)
                @for($i=57;$i<59;$i++)

                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        @php($acb =AccountOpeningBalance::where('account_name_id','=',$i)->where('month','=',$month)->where('year','=',$year)->first())
                        @php($acd = AccountJournalDetail::where('account_name_id','=',$i)->whereHas('accountJournal',function ($q) use($month,$year){
                                $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                            })->get())
                        @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))
                        @php($tac+=$ns)
                        <td></td>
                        <td></td>
                        <td>{{ AccountName::find($i)->title }}</td>
                        <td>
                            Rp. {{ thousand_format($ns) }}
                        </td>
                    </tr>
                @endfor

                @for($i=38;$i<39;$i++)
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        @php($acb =AccountOpeningBalance::where('account_name_id','=',$i)->where('month','=',$month)->where('year','=',$year)->first())
                        @php($acd = AccountJournalDetail::where('account_name_id','=',$i)->whereHas('accountJournal',function ($q) use($month,$year){
                                $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                            })->get())
                        @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))
                        @php($tac+=$ns)
                        <td></td>
                        <td></td>
                        <td>{{ AccountName::find($i)->title }}</td>
                        <td>
                            Rp. {{ thousand_format($ns) }}
                        </td>
                    </tr>
                @endfor

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"></td>
                    @php($tag+=$tac)
                    <td><b>Rp. {{ thousand_format($tac) }}</b></td>
                </tr>

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td colspan="5">&nbsp;</td>
                </tr>

                @php($tac=0)
                @for($i=84;$i<86;$i++)
                    <tr class=" dark:text-white text-black border-b border-gray-200 ">
                        @php($acb =AccountOpeningBalance::where('account_name_id','=',$i)->where('month','=',$month)->where('year','=',$year)->first())
                        @php($acd = AccountJournalDetail::where('account_name_id','=',$i)->whereHas('accountJournal',function ($q) use($month,$year){
                                $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);
                            })->get())
                        @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))
                        @php($tac+=$ns)
                        <td></td>
                        <td></td>
                        <td>{{ AccountName::find($i)->title }}</td>
                        <td>
                            Rp. {{ thousand_format($ns) }}
                        </td>
                    </tr>
                @endfor

                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"></td>
                    @php($tag+=$tac)
                    <td><b>Rp. {{ thousand_format($tac) }}</b></td>
                </tr>
                <tr class=" dark:text-white text-black border-b border-gray-200 ">
                    <td></td>
                    <td colspan="2"></td>

                    <td><b>Rp. {{ thousand_format($tag) }}</b></td>
                </tr>




                {{--                @php($count=17)--}}


                {{--                @foreach(AccountGroup::where('account_type_id','=',2)->orderByRaw("FIELD(id , 6,8,7,) ASC")->get() as $index=>$ag)--}}
                {{--                    @php($tag=0)--}}
                {{--                    @foreach(\App\Models\AccountCategory::whereIn('id',[]) as $index=>$ac)--}}
                {{--                        <tr class=" dark:text-white text-black border-b border-gray-200 ">--}}
                {{--                            <td class="text-start">{{ numberToRomanRepresentation($count) }}</td>--}}
                {{--                            <td colspan="2">{{ $ac->title }}, terdiri dari :</td>--}}
                {{--                            <td></td>--}}
                {{--                            <td></td>--}}
                {{--                        </tr>--}}

                {{--                        @if($ag->id==8)--}}
                {{--                            @php($accountCat=\App\Models\AccountCategory::find(4))--}}
                {{--                            <tr class=" dark:text-white text-black border-b border-gray-200 ">--}}
                {{--                                <td class="text-start"></td>--}}
                {{--                                <td colspan="2">{{ $accountCat->title }}aaaaaaaaaa</td>--}}
                {{--                                <td></td>--}}
                {{--                                <td></td>--}}
                {{--                            </tr>--}}
                {{--                            @foreach($accountCat->accountNames as $an)--}}
                {{--                                <tr class=" dark:text-white text-black border-b border-gray-200 ">--}}
                {{--                                    @php($acb =AccountOpeningBalance::where('account_name_id','=',$an->id)->where('month','=',$month)->where('year','=',$year)->first())--}}
                {{--                                    @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){--}}
                {{--                                            $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);--}}
                {{--                                        })->get())--}}
                {{--                                    @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))--}}
                {{--                                    @php($tac+=$ns)--}}
                {{--                                    <td></td>--}}
                {{--                                    <td></td>--}}
                {{--                                    <td>{{ $an->title }}</td>--}}
                {{--                                    <td>--}}
                {{--                                        Rp. {{ thousand_format($ns) }}--}}
                {{--                                    </td>--}}
                {{--                                </tr>--}}
                {{--                            @endforeach--}}
                {{--                        @endif--}}

                {{--                        @php($tac=0)--}}
                {{--                        @foreach($ac->accountNames as $an)--}}


                {{--                            <tr class=" dark:text-white text-black border-b border-gray-200 ">--}}
                {{--                                @php($acb =AccountOpeningBalance::where('account_name_id','=',$an->id)->where('month','=',$month)->where('year','=',$year)->first())--}}
                {{--                                @php($acd = AccountJournalDetail::where('account_name_id','=',$an->id)->whereHas('accountJournal',function ($q) use($month,$year){--}}
                {{--                                        $q->whereMonth('journal_date','=',$month)->whereYear('journal_date','=',$year);--}}
                {{--                                    })->get())--}}
                {{--                                @php($ns = ($acb->opening_balances??0) + $acd->sum('debit') - $acd->sum('credit'))--}}
                {{--                                @php($tac+=$ns)--}}
                {{--                                <td></td>--}}
                {{--                                <td></td>--}}
                {{--                                <td>{{ $an->title }}</td>--}}
                {{--                                <td>--}}
                {{--                                    Rp. {{ thousand_format($ns) }}--}}
                {{--                                </td>--}}
                {{--                            </tr>--}}
                {{--                        @endforeach--}}
                {{--                        <tr class=" dark:text-white text-black border-b border-gray-200 ">--}}
                {{--                            <td>&nbsp;</td>--}}
                {{--                            <td>&nbsp;</td>--}}
                {{--                            <td>&nbsp;</td>--}}
                {{--                            @php($tag+=$tac)--}}
                {{--                            <td><b>Rp. {{ thousand_format($tac) }}</b></td>--}}
                {{--                        </tr>--}}
                {{--                        @php($count+=1)--}}
                {{--                    @endforeach--}}
                {{--                    <tr class=" dark:text-white text-black border-b border-gray-200 ">--}}
                {{--                        <td>&nbsp;</td>--}}
                {{--                        <td>&nbsp;</td>--}}
                {{--                        <td>&nbsp;</td>--}}

                {{--                        <td><b>Rp. {{ thousand_format($tag) }}</b></td>--}}
                {{--                    </tr>--}}
                {{--                @endforeach--}}
                </tbody>
            </table>
        </div>

    </div>


</div>
