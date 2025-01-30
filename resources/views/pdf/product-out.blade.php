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

        .table table, .table th, .table td {
            border: 1px solid;
            padding: 10px;
            font-size: 14px;
        }

    </style>
</head>
<body>
@php
    $order = App\Models\OrderProductOut::find($outId);
    $partner = \App\Models\Partner::find($id);
    $count = 10 - $order->orderProductOutDetails->count();
@endphp
<img src="{{ $partner->kop!=null?public_path($partner->kop):'' }}" alt="" style="width: 100%">
<hr style="height: 5px; background: #1e1e1e; width: 90%">
<h1 style="text-align: center">BUKTI PENGELUARAN BARANG</h1>
<div style="padding: 10px 50px">
    <table style="width: 100%; line-height: 20px">
        <tr>
            <td>
                <div>
                    SURAT JALAN/SERAH TERIMA
                </div>
                <div>{{ $order->reference_waybill??'-' }}</div>
            </td>
            <td style="width: 40%"></td>
            <td>
                <div>Kepada Yth. {{ $order->order->customer->name }}</div>
                <div>{{ $order->order->customer->company_name }}</div>
            </td>
        </tr>
    </table>
    <br>
    <table class="table">
        <thead style="text-align: center; font-weight: bold">
        <tr>
            <td>No.</td>
            <td>Nama Barang</td>
            <td>Jumlah</td>
            <td>Keterangan</td>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderProductOutDetails as $index=>$opd)
            <tr style="height: 50px !important;">
                <td style="text-align: center">{{ $index+1 }}</td>
                <td>{{ $opd->orderProduct->name }}</td>
                <td style="text-align: center">{{ thousand_format($opd->quantity) }}</td>
                <td></td>
            </tr>
        @endforeach

        @for($i=0;$i<$count;$i++)
            <tr style="height: 50px !important;">
                <td style="text-align: center">{{ 11-$count+$i }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endfor
        </tbody>
    </table>
    <br><br>

    <table style="width: 100%">
        <tr>
            <td style="text-align: center">
                &nbsp; <br>
                &nbsp; <br>
                &nbsp; <br>
                &nbsp; <br>
                &nbsp; <br>
                Yang Menerima
                <br><br><br>
                (................................................)
            </td>
            <td style="width: 50%"></td>
            <td style="text-align: center">
                Jember,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br>
                &nbsp; <br>
                &nbsp; <br>
                Hormat kami <br>
                Yang Menyerahkan
                <br><br><br>
                (................................................)
            </td>
        </tr>
    </table>

</div>
</body>
</html>
