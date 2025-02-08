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
    use App\Models\Partner;
    use App\Models\OrderProofOfCash;

    $poc = OrderProofOfCash::find($poc);
    if ($poc->partner_id!=null){
        $partner = Partner::find($poc->partner_id);
    }else{
        $partner = Partner::find(1);
    }
@endphp
<img src="{{ $partner->kop!=null?public_path('storage/'.$partner->kop):'' }}" alt="" style="width: 100%">


<h2 style="text-align: center;"><u>KWITANSI</u></h2>
<div style="padding: 10px 50px">
    <table style="width: 90%; line-height: 20px">
        <tr style="vertical-align: top;">
            <td style="margin-bottom: 1200px">Telah diterima dari</td>
            <td style="width: 20px">:</td>
            <td style="width: 70%">
                <div style="width: 100%; border: 1px solid #333; height: 20px; padding: 2px 10px">
                    {{ $poc->order->customer->company_name??'' }}  {{ $poc->order->customer->name??'' }}
                </div>
                <br>
            </td>
        </tr>
        <tr style="vertical-align: top;">
            <td>Terbilang</td>
            <td style="width: 20px">:</td>
            <td style="width: 70%">
                <div style="width: 100%; border: 1px solid #333; height: 40px; padding: 2px 10px">
                    {{ ucwords(terbilang($poc->nominal)) }} Rupiah
                </div>
                <br>
            </td>
        </tr>
        <tr style="vertical-align: top;">
            <td>Untuk pembayaran</td>
            <td style="width: 20px">:</td>
            <td style="width: 70%">
                <div style="width: 100%; border: 2px solid #333; height: 20px; padding: 2px 10px">
                    {{ $poc->note }}
                </div>
                <br>
            </td>
        </tr>
        <tr style="vertical-align: top;">
            <td>Nominal</td>
            <td style="width: 20px">:</td>
            <td style="width: 70%">
                <div style="width: 100%; border: 2px solid #333; height: 20px; padding: 2px 10px; font-size: 15px">
                    <b>Rp. {{ thousand_format($poc->nominal) }},-</b>
                </div>
                <br>
            </td>
        </tr>
    </table>
    <br>

    <br><br>

    <table style="width: 90%">
        <tr>
            <td style="text-align: center">
                &nbsp; <br>
                Pemesan
                <br><br><br><br><br><br> <br>
                @if($poc->pic!=null)
                    ({{ $poc->pic }})
                @else
                    (................................................)
                @endif

            </td>
            <td style="width: 20%"></td>
            <td style="text-align: center">
                {{ $partner->name }} <br>
                {{ $partner->sign_position }} <br>
                <br><br><br><br><br><br>
                ({{ $partner->sign_name }})
            </td>
        </tr>
    </table>

</div>
</body>
</html>
