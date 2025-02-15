<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        @page {
            margin: 0in;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse
        }

        .table, .table thead{
            border: 1px solid;
         }

        .table td{
            border-right: 1px solid;
        }

        .table table, .table th, .table td {

            padding: 5px;
            font-size: 14px;
        }
        .total{
            border: 1px solid; background: #dddddd
        }

    </style>
</head>
<body>

<img src="{{ public_path('assets/kop.jpg') }}" alt="" style="width: 100%">
<br><br>
<h2 style="text-align: center;margin: 0"><u>GAJI KARYAWAN</u></h2>
<h3 style="text-align: center;margin: 0">{{ $salary->reference }}</h3>
<div style="padding: 10px 50px">
    <br>
    <table style="width: 50%">
        <tr>
            <td>Nama </td>
            <td>:</td>
            <td>{{ $salary->user->name }}</td>
        </tr>
        <tr>
            <td>Posisi </td>
            <td>:</td>
            <td>{{ $salary->user->position }}</td>
        </tr>
    </table>
    <br>
    <table class="table">
        <thead>
        <tr>
            <td style="width: 20px;">No.</td>
            <td style="padding-left: 20px">Keterangan</td>
            <td style="padding-left: 20px">Jumlah</td>
        </tr>
        </thead>

        <tr>
            <td style="text-align: center">1. </td>
            <td style="padding-left: 20px">Gaji Pokok</td>
            <td class="" style="padding: 0 20px; margin: 0">
                <table style="width: 100%;">
                    <tr>
                        <td style="border: none; padding: 0">Rp. </td>
                        <td style="border: none;padding: 0; width: 100%"></td>
                        <td style="border: none;padding: 0">{{ thousand_format($salary->salary) }}</td>
                    </tr>
                </table>
            </td>


        </tr>
        <tr>
            <td style="text-align: center">2. </td>
            <td style="padding-left: 20px">Bonus</td>
            <td class="" style="padding: 0 20px; margin: 0">
                <table style="width: 100%;">
                    <tr>
                        <td style="border: none; padding: 0">Rp. </td>
                        <td style="border: none;padding: 0; width: 100%"></td>
                        <td style="border: none;padding: 0">{{ thousand_format($salary->bonus) }}</td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td style="text-align: center">3. </td>
            <td style="padding-left: 20px">Tunjangan</td>
            <td class="" style="padding: 0 20px; margin: 0">
                <table style="width: 100%;">
                    <tr>
                        <td style="border: none; padding: 0">Rp. </td>
                        <td style="border: none;padding: 0; width: 100%"></td>
                        <td style="border: none;padding: 0">{{ thousand_format($salary->allowance) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">4. </td>
            <td style="padding-left: 20px">Transportasi</td>
            <td class="" style="padding: 0 20px; margin: 0">
                <table style="width: 100%;">
                    <tr>
                        <td style="border: none; padding: 0">Rp. </td>
                        <td style="border: none;padding: 0; width: 100%"></td>
                        <td style="border: none;padding: 0">{{ thousand_format($salary->transportation) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <thead>
        <tr style="border-top: 1px black">
            <td colspan="2">Total</td>
            <td class="" style="padding: 0 20px; margin: 0">
                <table style="width: 100%;">
                    <tr>
                        <td style="border: none; padding: 0">Rp. </td>
                        <td style="border: none;padding: 0; width: 100%"></td>
                        <td style="border: none;padding: 0">{{ thousand_format($salary->transportation+$salary->bonus+$salary->salary+$salary->allowance) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        </thead>

    </table>
    <br>
    <div style="margin-bottom: 5px">
        Catatan :
    </div>
    <div style="border: 1px solid black; height: 100px; padding: 10px">
{{ $salary->note }}
    </div>


{{--    <h4 style="margin: 20px 0 0 350px ">Nama: {{ $order->customer->company_name }} - {{ $order->customer->name }}</h4>--}}
{{--    <table class="table">--}}
{{--        <thead style="text-align: center; font-weight: bold">--}}
{{--        <tr>--}}
{{--            <td>No.</td>--}}
{{--            <td>Satuan</td>--}}
{{--            <td>Nama Barang</td>--}}
{{--            <td>Harga</td>--}}
{{--            <td>Total</td>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($order->orderProducts as $index=>$opd)--}}
{{--            @if($opd->partner_id==$id)--}}
{{--                @php--}}
{{--                $count-=1;--}}
{{--                $total+=($opd->quantity*$opd->price);--}}
{{--                @endphp--}}
{{--            <tr style="height: 10px !important;">--}}
{{--                <td style="text-align: center">{{ $index+1 }}</td>--}}
{{--                <td style="text-align: center">{{ thousand_format($opd->quantity) }}</td>--}}
{{--                <td>{{ $opd->name }}</td>--}}
{{--                <td class="" style="padding: 0; margin: 0">--}}
{{--                    <table style="width: 100%;">--}}
{{--                        <tr>--}}
{{--                            <td style="border: none; padding: 0">Rp. </td>--}}
{{--                            <td style="border: none;padding: 0; width: 100%"></td>--}}
{{--                            <td style="border: none;padding: 0">{{ thousand_format($opd->price) }}</td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </td>--}}
{{--                <td class="" style="padding: 0; margin: 0">--}}
{{--                    <table style="width: 100%;">--}}
{{--                        <tr>--}}
{{--                            <td style="border: none; padding: 0">Rp. </td>--}}
{{--                            <td style="border: none;padding: 0; width: 100%"></td>--}}
{{--                            <td style="border: none;padding: 0">{{ thousand_format($opd->quantity*$opd->price) }}</td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            @endif--}}
{{--        @endforeach--}}

{{--        @for($i=0;$i<$count;$i++)--}}
{{--            <tr style="height: 30px !important;">--}}
{{--                <td style="text-align: center">&nbsp;</td>--}}
{{--                <td></td>--}}
{{--                <td></td>--}}
{{--                <td></td>--}}
{{--                <td></td>--}}
{{--            </tr>--}}
{{--        @endfor--}}

{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td class="total">--}}
{{--                Sub total--}}
{{--            </td>--}}
{{--            <td class="total" style="padding: 0; margin: 0">--}}
{{--                <table style="width: 100%;">--}}
{{--                    <tr>--}}
{{--                        <td style="border: none; padding: 0">Rp. </td>--}}
{{--                        <td style="border: none;padding: 0; width: 100%"></td>--}}
{{--                        <td style="border: none;padding: 0">{{ thousand_format($total) }}</td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td class="total">--}}
{{--                DP--}}
{{--            </td>--}}
{{--            <td class="total" style="padding: 0; margin: 0">--}}
{{--                <table style="width: 100%;">--}}
{{--                    <tr>--}}
{{--                        <td style="border: none; padding: 0">Rp. </td>--}}
{{--                        <td style="border: none;padding: 0; width: 100%"></td>--}}
{{--                        <td style="border: none;padding: 0">{{ thousand_format($orderInvoice->down_payment) }}</td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td class="total">--}}
{{--                Sisa--}}
{{--            </td>--}}
{{--            <td class="total" style="padding: 0; margin: 0">--}}
{{--                <table style="width: 100%;">--}}
{{--                    <tr>--}}
{{--                        <td style="border: none; padding: 0">Rp. </td>--}}
{{--                        <td style="border: none;padding: 0; width: 100%"></td>--}}
{{--                        <td style="border: none;padding: 0">{{ thousand_format($total-$orderInvoice->down_payment) }}</td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td class="total">--}}
{{--                Pajak--}}
{{--            </td>--}}
{{--            <td class="total" style="text-align: right">--}}
{{--                {{ thousand_format($orderInvoice->tax)??'-' }}%--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td class="total">--}}
{{--                Ongkos Kirim--}}
{{--            </td>--}}
{{--            <td class="total" style="padding: 0; margin: 0">--}}
{{--                <table style="width: 100%;">--}}
{{--                    <tr>--}}
{{--                        <td style="border: none; padding: 0">Rp. </td>--}}
{{--                        <td style="border: none;padding: 0; width: 100%"></td>--}}
{{--                        <td style="border: none;padding: 0">{{ thousand_format($orderInvoice->shipping_cost) }}</td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td class="total">--}}
{{--                Grand total--}}
{{--            </td>--}}

{{--            <td class="total" style="padding: 0; margin: 0">--}}
{{--                <table style="width: 100%;">--}}
{{--                    <tr>--}}
{{--                        <td style="border: none; padding: 0">Rp. </td>--}}
{{--                        <td style="border: none;padding: 0; width: 100%"></td>--}}
{{--                        <td style="border: none;padding: 0">{{ thousand_format($total-$orderInvoice->down_payment+$orderInvoice->shipping_cost) }}</td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <br><br>--}}
{{--    {!! $partner->invoice_note !!}--}}

{{--    <table style="width: 80%; margin-left: 10%">--}}
{{--        <tr>--}}
{{--            <td style="text-align: center">--}}
{{--                &nbsp; <br>--}}
{{--                &nbsp; <br>--}}
{{--                &nbsp; <br>--}}
{{--                &nbsp; <br>--}}
{{--                &nbsp; <br>--}}
{{--                Customer--}}
{{--                <br><br><br><br><br><br><br><br><br>--}}
{{--                (................................................)--}}
{{--            </td>--}}
{{--            <td style="width: 30%"></td>--}}
{{--            <td style="text-align: center">--}}
{{--                Jember,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                <br>--}}
{{--                &nbsp; <br>--}}
{{--                &nbsp; <br>--}}
{{--                Hormat kami <br>--}}
{{--                {{ $partner->name }} <br>--}}
{{--                {{ $partner->sign_position }} <br>--}}
{{--                <br><br><br><br><br><br><br>--}}
{{--                ({{ $partner->sign_name }})--}}

{{--            </td>--}}
{{--        </tr>--}}
{{--    </table>--}}

</div>
</body>
</html>
