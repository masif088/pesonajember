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
<img src="{{ public_path('front/background-pdf-salary.jpg') }}" alt="" style="position: absolute; width: 100%">
<div style="position: absolute; z-index: 2; width: 100%; padding: 170px 8%;">
    <div style="width: 84% ">
        <div>
            <div
                style="background: #465E89; margin-left: auto; color: white; display: flex; flex: fit-content; padding: 10px; width: 400px; border-radius: 10px 10px 0 0; justify-content: space-between">
                <table style="width: 100%">
                    <tr>
                        <td>No Refrensi : {{ $salary->reference }}</td>
                        <td></td>
                        <td style="text-align: right">Tanggal : {{ $salary->created_at->format('d') .' '.month_name(intval($salary->created_at->format('m'))) .' '.$salary->created_at->format('Y') }}</td>
                    </tr>
                </table>
            </div>
            <div style="width: 100%; background: #E9E9E9; ">

                <table style="width: 100%;padding: 10px">
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $salary->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>Pegawai</td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                        <td style="text-align: right">

                        </td>
                    </tr>
                </table>
            </div>
            <br><br>
            <div>
                <table class="invoice-table">
                    <thead>
                    <tr style="text-align: center; background: #465E89; color: white">
                        <td style="padding: 5px;width: 10%">#</td>
                        <td style="text-align: left">Keterangan</td>
                        <td style="width: 20%">Jumlah</td>

                    </tr>
                    </thead>
                    <tbody>


                    <tr style="border-bottom: 1px solid #C6C6C6">
                        <td style="text-align: center; width: 5%">1</td>
                        <td>Gaji Pokok</td>
                        <td style="text-align: right">Rp. {{ thousand_format($salary->basic_salary) }}</td>
                    </tr>

                    <tr style="border-bottom: 1px solid #C6C6C6">
                        <td style="text-align: center; width: 5%">2</td>
                        <td>Bonus</td>
                        <td style="text-align: right">Rp. {{ thousand_format($salary->bonus) }}</td>
                    </tr>

                    <tr style="border-bottom: 1px solid #C6C6C6">
                        <td style="text-align: center; width: 5%">3</td>
                        <td>Lembur</td>
                        <td style="text-align: right">Rp. {{ thousand_format($salary->overtime) }}</td>
                    </tr>

                    <tr style="border-bottom: 1px solid #C6C6C6">
                        <td style="text-align: center; width: 5%">4</td>
                        <td>Tunjangan Transportasi</td>
                        <td style="text-align: right">Rp. {{ thousand_format($salary->transportation) }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #C6C6C6">
                        <td style="text-align: center; width: 5%">5</td>
                        <td>Potongan Hutang</td>
                        <td style="text-align: right">Rp. {{ thousand_format($salary->debt_deduction) }}</td>
                    </tr>

                    <tr style="border-bottom: 1px solid #C6C6C6">
                        <td style="text-align: center; width: 5%">6</td>
                        <td>Potongan Hutang</td>
                        <td style="text-align: right">Rp. {{ thousand_format($salary->employee_cooperative_deductions) }}</td>
                    </tr>



                    <tr style="border-bottom: 1px solid #C6C6C6">
                        <td style="text-align: center; width: 5%"></td>
                        <td><b>Total Gaji Diterima</b></td>

                        @php($salaryGet =  $salary->basic_salary+$salary->bonus+$salary->overtime+$salary->transportation-$salary->debt_deduction-$salary->employee_cooperative_deductions)

                        <td style="text-align: right"><b>Rp. {{ thousand_format($salaryGet) }}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br><br><br>
            <div>
                <font style="color: #465E89; font-weight: 700">Catatan : </font><br>
                {{ $salary->note }}
            </div>

            <br>

            <br><br>

            <div style="text-align: center">
                <img src="{{ public_path('front/ttd.png') }}" alt="" style="width: 150px"><br>
                <font style="color: #465E89; font-weight: 700">KUN SENTAWAN</font> <br>
            </div>


        </div>

    </div>
</div>
</body>
</html>
