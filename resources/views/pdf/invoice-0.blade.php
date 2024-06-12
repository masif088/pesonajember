@php use App\Models\PaymentModel;use App\Models\Product; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            margin: 0in;
            font-size: 12px;
            font-family: sans-serif !important;
        }

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

        {{--body {--}}
        {{--    background-image: url({{ public_path('front/background-pdf.jpg') }});--}}
        {{--    background-position: top left;--}}
        {{--    background-repeat: no-repeat;--}}
        {{--    background-size: 100%;--}}
        {{--    width: 100%;--}}
        {{--    height: 100%;--}}
        {{--}--}}
    </style>
</head>
<body style=" ">
<img src="{{ public_path('front/background-pdf.jpg') }}" alt="" style="position: absolute; width: 100%">
<div style="position: absolute; z-index: 2; width: 100%; padding: 170px 8%;">
    <div style="width: 84% ">
        <div>
            <div
                style="background: #465E89; margin-left: auto; color: white; display: flex; flex: fit-content; padding: 10px; width: 400px; border-radius: 10px 10px 0 0; justify-content: space-between">
                <table style="width: 100%">
                    <tr>
                        <td>No Invoice : {{ $transaction->uid }}</td>
                        <td></td>
                        <td style="text-align: right">Tanggal
                            : {{ $transaction->created_at->format('d') .' '.month_name(intval($transaction->created_at->format('m'))) .' '.$transaction->created_at->format('Y') }}</td>
                    </tr>
                </table>
            </div>
            <div style="width: 100%; background: #E9E9E9; ">

                <table style="width: 100%;padding: 10px">
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
            <br><br>
            <div>
                <table class="invoice-table">
                    <thead>
                    <tr style="text-align: center; background: #465E89; color: white">
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
                                    {{ \App\Models\Shipper::find($tl['shipper_id'])->title }} <br>
                                @elseif($tl['transaction_detail_type_id']==2)
                                    @php($product =Product::find($tl['product_id']) )
                                    <b>{{ $product->title }}</b> <br>
                                    {{ $product->productCategory->title }} <br>
                                    {{ $product->note }}
                                @endif
                            </td>
                            <td style="text-align: center">
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
                    {{--                    <tr>--}}
                    {{--                        <td></td>--}}
                    {{--                        <td></td>--}}
                    {{--                        <td></td>--}}
                    {{--                        <td>Total Diskon</td>--}}
                    {{--                        <td>Rp. 800.000</td>--}}
                    {{--                    </tr>--}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">
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
                        <td colspan="2" style="background: #597FC1; border:1px solid #597FC1;padding: 5px">
                            <table style="width: 100%; color: white; font-weight: bold">
                                <tr>
                                    <td style="padding: 0;width: 30%">TOTAL:</td>
                                    <td style="padding: 0;width: 25%"></td>
                                    <td style="padding: 0">Rp.</td>
                                    <td style="padding: 0; text-align: right; padding-right: 5px">
                                        {{ thousand_format(($total+($total*(is_numeric($transaction->tax)?$transaction->tax:0)/100))) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="border:1px solid #597FC1; padding: 5px">
                            <table style="width: 100%; color: black; font-weight: 400">
                                <tr>
                                    <td style="padding: 0;width: 30%">Telah Terbayar:</td>
                                    <td style="padding: 0;width: 25%"></td>
                                    <td style="padding: 0">Rp.</td>
                                    <td style="padding: 0; text-align: right; padding-right: 5px">
                                        0
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="border:1px solid #597FC1; padding: 5px">
                            <table style="width: 100%; color: black; font-weight: 400">
                                <tr>
                                    <td style="padding: 0;width: 30%">Belum di Bayar:</td>
                                    <td style="padding: 0;width: 25%"></td>
                                    <td style="padding: 0">Rp.</td>
                                    <td style="padding: 0; text-align: right; padding-right: 5px">
                                        {{ thousand_format(($total+($total*(is_numeric($transaction->tax)?$transaction->tax:0)/100))) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <div>
                <font style="color: #465E89; font-weight: 700">RINCIAN PEMBAYARAN : </font><br>
                @foreach(explode(':',PaymentModel::find($transaction->payment_model_id)->model) as $index=>$m)
                    Pembayaran ke {{$index+1}}:
                    Rp. {{ thousand_format(($total+($total*(is_numeric($transaction->tax)?$transaction->tax:0)/100))*$m/100) }}
                    <br>
                @endforeach
            </div>

            <br>
            <div>
                <font style="color: #465E89; font-weight: 700">PAYMENT METHOD : </font><br>
                Rek BCA 4480364029 a.n Kun Sentanawan
            </div>

            <br>
            <div>
                <font style="color: #465E89; font-weight: 700">KETENTUAN : </font><br>
                <ol>
                    <li>Minimal pemesanan 24 pcs per article</li>
                    <li>Sample akan di buatkan minimal 7 hari setelah DP</li>
                    <li>Revisi hanya bisa di lakukan 1x proses produksi 2-4 minggu</li>
                    <li>Pengambilan barang di wajibkan setelah melunasi pembayaran</li>
                </ol>
            </div>

            <br><br>

            <div style="text-align: center">
                <img src="{{ public_path('front/ttd.png') }}" alt="" style="width: 150px"><br>
                <font style="color: #465E89; font-weight: 700">KUN SENTAWAN</font>
            </div>


        </div>

    </div>
</div>
</body>
</html>
