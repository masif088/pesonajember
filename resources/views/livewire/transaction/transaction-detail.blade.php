@php use App\Models\Product; @endphp
@php use Carbon\Carbon; @endphp
<div>
    <style>
        .invoice-table {
            width: 100%;
            border-collapse: collapse
        }

        .invoice-table tbody td {
            padding: 10px;
        }

        .invoice-table thead td {
            padding: 5px;
        }

    </style>

    <div class="flex gap-2 mb-2">
        <a href="{{ route('transaction.download-new-order',$transaction->id) }}" class="btn bg-wishka-600" target="_blank">Download Invoice Pesanan Baru</a>
        <a href="{{ route('transaction.download',$transaction->id) }}" class="btn bg-wishka-600" target="_blank">Download Invoice Pelunasan</a>
    </div>


    <div class="text-md md:w-12/12 lg:w-6/12 p-3 flex flex-fill text-white ml-auto bg-wishka-500 justify-between"
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
    <div class="p-3 w-12/12 bg-gray-200 text-md">
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
    <div class="grid grid-cols-12 gap-10">


        <div class="lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">


            <h2 class="text-xl font-bold text-wishka-600 mb-2">Detail Pembelian</h2>
            <table class="invoice-table w-full">
                <thead>
                <tr class="bg-wishka-600 text-center text-white">
                    <td style="padding: 5px">#</td>
                    <td>Pesanan</td>
                    <td>Jumlah</td>
                    <td>Harga Satuan</td>
                    <td>Total</td>
                </tr>
                </thead>
                <tbody>

                @php($total=0)

                @foreach($transaction->transactionLists as $index=>$tl)
                    <tr style="border-bottom: 1px solid #C6C6C6">
                        <td style="text-align: center">{{ $index+1 }}</td>
                        <td>
                            @if($tl['transaction_detail_type_id']==1)
                                <b>{{ $tl['shipper_category'] }} </b><br>
                                {{ Shipper::find($tl['shipper_id'])->title }} <br>
                            @elseif($tl['transaction_detail_type_id']==2)
                                @php($product =Product::find($tl['product_id']) )
                                <b>{{ $product->title }}</b> <br>
                                {{ $product->productCategory->title }} <br>
                                {{ $product->note }}
                            @endif
                        </td>
                        <td style="text-align: right">
                            @if(is_numeric($tl['amount']))
                                {{ thousand_format($tl['amount']) }}pcs
                            @else
                                {{ $tl['amount'] }}
                            @endif
                        </td>
                        <td style="text-align: right">
                            @if(is_numeric($tl['amount']))
                                Rp. {{ thousand_format($tl['price'])  }}
                            @else
                                -
                            @endif
                        </td>
                        <td style="text-align: right">
                            @if($tl['transaction_detail_type_id']==1)
                                @php($total+=$tl['price'])
                                Rp. {{ thousand_format($tl['price']) }}
                            @elseif($tl['transaction_detail_type_id']==2)
                                @php($total+=$tl['price']*$tl['amount'])
                                Rp. {{ thousand_format($tl['price']*$tl['amount']) }}
                            @endif
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Sub Total:</td>
                    <td><b>Rp. {{ thousand_format($total) }}</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        Pajak ({{is_numeric($transaction->tax)?$transaction->tax:0}}%)
                    </td>
                    <td>
                        <b>Rp. {{ thousand_format($total*(is_numeric($transaction->tax)?$transaction->tax:0)/100) }}</b>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="background: #597FC1; ">
                        <table style="width: 100%; color: white; font-weight: 900">
                            <tr>
                                <td style="padding: 0">TOTAL:</td>
                                <td style="padding: 0;width: 30%"></td>
                                <td style="padding: 0">Rp.</td>
                                <td style="padding: 0">
                                    Rp. {{ thousand_format(($total+($total*(is_numeric($transaction->tax)?$transaction->tax:0)/100))) }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>


        <div class="lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">
            <h2 class="text-xl font-bold text-wishka-600 mb-2">Detail Pembayaran</h2>
            <table class="invoice-table w-full">
                <thead>
                <tr class="bg-wishka-600 text-center text-white">
                    <td style="padding: 5px">#</td>
                    <td>Judul</td>
                    <td>Jumlah uang</td>
                    <td>Tanggal Pembayaran</td>
                </tr>
                </thead>
                <tbody>
                @foreach($transaction->transactionPayments as $index=>$tl)
                    <tr style="border-bottom: 1px solid #C6C6C6;" class="text-center">
                        <td style="text-align: center">{{ $index+1 }}</td>
                        <td>{{ $tl->title }}</td>
                        <td>Rp. {{ thousand_format($tl['amount'] ) }}</td>
                        <td>{{ get_date_format(Carbon::parse($tl['payment_at'])) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


        <div class="lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">
            <div class="card">
                <div class="card-body pb-8">
                    <h5 class="card-title">
                        Detail Transaksi
                    </h5>
{{--                    <p class="card-subtitle">--}}
{{--                        How to Secure Recent Transactions--}}
{{--                    </p>--}}

                    <div class="mt-6">
                        @foreach($transaction->transactionStatuses->sortByDesc('id') as $index=>$ts)
                            {{--                        {{ dd($loop->count) }}--}}
                            <!-- Item -->
                            <div class="flex gap-x-3">
                                <div class="w-1/4 text-end">
                                    <div class="font-bold">{{ get_date_format($ts->created_at) }}</div>
                                    <div class="">{{ $ts->created_at->format('H:i') }}</div>
                                </div>
                                {{--                        <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px]  ">--}}
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
                                        {{ $ts->transactionStatusType->title }} <br>
                                        @foreach($ts->transactionStatusAttachments as $tsa)
                                            <font class="capitalize">{{ $tsa->key }}</font> :
                                            @if($tsa->type == 'string')
                                                {{ $tsa->value }}
                                            @elseif($tsa->type == 'image')
                                                <img src="{{ asset(str_replace('public','storage',$tsa->value)) }}" alt="" style="width: 250px">
                                            @else
                                                @php($model = new $status->type())
                                                {{ $model->find($status->value)->name }}
                                            @endif
                                            <br>
                                        @endforeach
                                    </p>
                                </div>
                            </div>

                            <!-- End Item -->
                        @endforeach

                    </div>
                </div>

            </div>
            <!--Recent Transactions Card End-->


        </div>
    </div>


</div>
