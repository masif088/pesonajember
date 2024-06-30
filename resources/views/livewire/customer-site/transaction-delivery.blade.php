@php use App\Models\TransactionList;use Carbon\Carbon; @endphp
<div class="card">
    <div class="card-body pb-8">
        <h5 class="card-title">
            Detail Transaksi
        </h5>

        <div class="mt-6">
            @foreach($transaction->transactionStatuses->sortByDesc('created_at') as $index=>$ts)
                @php
                    $resi = '';
                    $shipper = '';
                    $tracking = '';

                    $resi  = $ts->transactionStatusAttachments->where('key','resi pengiriman')->first();
                        $shipper  = $ts->transactionStatusAttachments->where('key','ekpedisi pengiriman')->first();
                        if ($resi!=null && $shipper!=null){
                            $this->getTrack($ts->id);

                        $tracking  = $ts->transactionStatusAttachments->where('key','traking pengiriman')->first();

                    }
                @endphp
                @if($tracking!=null)
                    @foreach(array_reverse(json_decode($tracking->value)->history) as $history )
                        <div class="flex gap-x-3">
                            <div class="w-1/4 text-end">
                                <div
                                    class="font-bold">{{ get_date_format(Carbon::parse($history->updated_at)) }}</div>
                                <div class="">{{ Carbon::parse($history->updated_at)->format('H:i') }}</div>
                            </div>
                            <div
                                class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] @if($index != 0) after:bg-border dark:after:bg-darkborder @endif">
                                <div class="relative z-10 w-7 h-7 flex justify-center items-center">
                                    <div
                                        class="h-3 w-3 rounded-full border-2 @if($loop->count != $index+1  ) border-success bg-transparent @else  @if($ts->transactionStatusType->title == 'Selesai') border-success bg-success @else border-warning bg-warning @endif  @endif">
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/4 grow pt-0.5 pb-6">
                                <p class="">
                                    {{ $history->status }} <br>
                                    {{ $history->note }} <br>
                                </p>
                                @if($ts->transaction_list_id!=null)
                                    Kode Produksi:
                                    <b>{{ TransactionList::find($ts->transaction_list_id)->uid }}</b>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif


                <!-- Item -->
                <div class="flex gap-x-3">
                    <div class="w-1/4 text-end">
                        <div class="font-bold">{{ get_date_format($ts->created_at) }}</div>
                        <div class="">{{ $ts->created_at->format('H:i') }}</div>
                    </div>
                    <div
                        class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] @if($index != 0) after:bg-border dark:after:bg-darkborder @endif">
                        <div class="relative z-10 w-7 h-7 flex justify-center items-center">
                            <div
                                class="h-3 w-3 rounded-full border-2 @if($loop->count != $index+1  ) border-success bg-transparent @else  @if($ts->transactionStatusType->title == 'Selesai') border-success bg-success @else border-success @endif  @endif">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/4 grow pt-0.5 pb-6">
                        <p class="">

                            {{ $ts->transactionStatusType->title }} <br>
                            @foreach($ts->transactionStatusAttachments as $tsa)
                                <font class="capitalize">{{ $tsa->key!="pic"?"$tsa->key :":'' }} </font>
                                @if($tsa->type == 'string')
                                    {{ $tsa->value }}
                                @elseif($tsa->type == 'image')
                                    <img src="{{ asset(str_replace('public','storage',$tsa->value)) }}" alt=""
                                         style="width: 250px">
                                @elseif($tsa->type == 'file')
                                    <a href="{{ route('customer.transaction-download-pdf',base64_encode($tsa->value)) }}"
                                       class="px-2 py-1 rounded-md bg-wishka-400 text-white">Download</a>
                                @elseif($tsa->type == 'tracking')

                                @else
                                    @if(auth()->user()!=null)
                                        <font class="capitalize">{{ $tsa->key }}</font> : {{ $tsa->type::withTrashed()->find($tsa->value)->name??'' }}
                                    @endif
                                @endif
                                <br>
                            @endforeach
                            @if($ts->transaction_list_id!=null)
                                Kode Produksi:
                                <b>{{ TransactionList::find($ts->transaction_list_id)->uid }}</b>
                            @endif
                        </p>
                    </div>
                </div>




                <!-- End Item -->
            @endforeach

        </div>
    </div>

</div>
