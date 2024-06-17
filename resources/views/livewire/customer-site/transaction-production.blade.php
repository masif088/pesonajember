<div class="lg:grid grid-cols-12">
    <div class="col-span-12">
        <h2 class="text-2xl mb-2">Traking Produksi</h2>
        <br>
        <div class="text-md md:w-12/12 lg:w-6/12 p-3 flex flex-fill font-bold ml-auto justify-between"
             style="border-radius: 10px 10px 0 0;">
            <table style="width: 100%">
                <tr>
                    <td>No Invoice : {{ $transaction->uid }}</td>
                    <td></td>
                    <td style="text-align: right">
                        Tanggal : {{ get_date_format($transaction->created_at) }}</td>
                </tr>
            </table>
        </div>
        <div class="p-3 w-12/12 text-md">
            <table class="w-full p-3">
                <tr>
                    <td>
                        <b>Dari, <br> Wishka Company</b> <br>
                        Vendor Tas Malang <br>
                        Jl Mayar No 30, Sukun, Kota Malang <br>
                        + 62 812 5268 7268 / +62 895 3372 63639
                    </td>
                    <td></td>
                    <td style="text-align: right">
                        <b>Kepada,</b> <br>
                        <b>{{ $transaction->customer->name }}</b> <br>
                        {{ $transaction->customer->address }} <br>
                        {{ $transaction->customer->phone }}
                    </td>
                </tr>
            </table>
        </div>
        <br>

        <div class="lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">
            <div class="card">
                <div class="card-body pb-8">
                    <h5 class="card-title">
                        Detail Transaksi
                    </h5>

                    <div class="mt-6">
                        @foreach($transaction->transactionStatuses->sortByDesc('id') as $index=>$ts)
                            @php
                                $resi = '';
                                $shipper = '';
                                $tracking = '';

                                if ($ts->transaction_status_type_id == 14){
                                    $resi  = $ts->transactionStatusAttachments->where('key','resi pengiriman')->first();
                                    $shipper  = $ts->transactionStatusAttachments->where('key','ekpedisi pengiriman')->first();
                                    if ($resi!=null && $shipper!=null){
                                        $this->getTrack($ts->id);
                                    }
                                    $tracking  = $ts->transactionStatusAttachments->where('key','traking pengiriman')->first();
//                                    dd(json_decode($tracking->value));
                                }
                            @endphp
                            @if($tracking!=null)
                                @foreach(array_reverse(json_decode($tracking->value)->history) as $history )

                                    <div class="flex gap-x-3">
                                        <div class="w-1/4 text-end">
                                            <div class="font-bold">{{ get_date_format(\Carbon\Carbon::parse($history->updated_at)) }}</div>
                                            <div class="">{{ \Carbon\Carbon::parse($history->updated_at)->format('H:i') }}</div>
                                        </div>
                                        <div
                                            class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] @if($index != 0) after:bg-border dark:after:bg-darkborder @endif">
                                            <div class="relative z-10 w-7 h-7 flex justify-center items-center">
                                                <div class="h-3 w-3 rounded-full border-2 @if($loop->count != $index+1  ) border-success bg-transparent @else  @if($ts->transactionStatusType->title == 'Selesai') border-success bg-success @else border-warning bg-warning @endif  @endif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-1/4 grow pt-0.5 pb-6">
                                            <p class="">
                                                {{ $history->status }} {{ $ts->id }} <br>
                                                {{ $history->note }} <br>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            <!-- Item -->
                            <div class="flex gap-x-3">
                                <div class="w-1/4 text-end">
                                    <div class="font-bold">{{ get_date_format($ts->created_at) }}</div>
                                    <div class="">{{ $ts->created_at->format('H:i') }}</div>
                                </div>
                                <div
                                    class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] @if($index != 0) after:bg-border dark:after:bg-darkborder @endif">
                                    <div class="relative z-10 w-7 h-7 flex justify-center items-center">
                                        <div class="h-3 w-3 rounded-full border-2 @if($loop->count != $index+1  ) border-success bg-transparent @else  @if($ts->transactionStatusType->title == 'Selesai') border-success bg-success @else border-warning bg-warning @endif  @endif">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/4 grow pt-0.5 pb-6">
                                    <p class="">
                                        {{ $ts->transactionStatusType->title }} <br>
                                        @foreach($ts->transactionStatusAttachments as $tsa)
                                            <font class="capitalize">{{ $tsa->key }}</font> :
                                            @if($tsa->type == 'string')
                                                {{ $tsa->value }}
                                            @elseif($tsa->type == 'image')
                                                <img src="{{ asset(str_replace('public','storage',$tsa->value)) }}" alt="" style="width: 250px">
                                            @else
                                                {{ $tsa->type::withTrashed()->find($tsa->value)->name??'' }}
                                            @endif
                                            <br>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            @endif

                            <!-- End Item -->
                        @endforeach

                    </div>
                </div>

            </div>
            <!--Recent Transactions Card End-->
        </div>

    </div>
</div>
