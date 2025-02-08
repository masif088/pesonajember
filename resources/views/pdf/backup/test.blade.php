<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body style=" ">
<div>
    <h1>MOCKUP PESANAN</h1>
    <div style="width: 100%">
        <table style="width: 100%">
            <tr>
                <td style="text-align: end">
                    <b>Customer: </b>
                    <b>{{ $transaction->customer->name }},</b> <br>
                    {{ $transaction->customer->province??'' }}, {{ $transaction->customer->city??'' }}
                    , {{ $transaction->customer->district??'' }}<br>
                    {{ $transaction->customer->phone }}/{{ $transaction->customer->email }}
                </td>

                <td style="text-align: end">
                    ID Customer : {{ $transaction->customer->uid }}<br>
                    ID Transaksi : {{ $transaction->uid }}<br>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div style="width: 100%">
        <table style="width: 100%">
            <tr>
                <td>
                    <b>Kode produk :</b><br>
                    <input type="text" class=""
                           value="{{ $transactionList->product->uid??'Tidak ada produk di transaksi ini' }}"
                           style="background: #f0f0f0; border-radius: 5px; width: 90%;padding: 10px 20px; border: none;">
                </td>
                <td></td>
                <td>
                    <b>Ukuran produk :</b><br>
                    <input type="text" class=""
                           value="{{ $transactionList->product->size??'Tidak ada produk di transaksi ini' }}"
                           style="background: #f0f0f0; border-radius: 5px; width: 90%;padding: 10px 20px; border: none">
                </td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td>
                    <b>Nama produk :</b><br>
                    <input type="text" class=""
                           value="{{ $transactionList->product->title??'Tidak ada produk di transaksi ini' }}"
                           style="background: #f0f0f0; border-radius: 5px; width: 90%;padding: 10px 20px; border: none">
                </td>
                <td></td>
                <td>
                    <b>Jumlah produk :</b><br>
                    <input type="text" class=""
                           value="{{ $transactionList->amount??'Tidak ada produk di transaksi ini' }}"
                           style="background: #f0f0f0; border-radius: 5px; width: 90%;padding: 10px 20px; border: none">
                </td>
            </tr>
        </table>
    </div>

    <h2>Sampel pesanan</h2>
    @php($mockup=$transactionList->transactionStatuses->where('transaction_status_type_id','=',3)->first())
    @if($mockup!=null)
        @php($mockup2=$mockup->transactionStatusAttachments->where('key','=','photo mockup')->first())
        @if($mockup2!=null)

            <img src="{{ public_path(str_replace('public','storage',$mockup2->value)) }}"
                 style="max-width: 100%;max-height: 400px" alt="">
        @else
            <div style="border: 1px solid black; height: 100px; width: 300px">
                <br><br>
                tidak ada mockup
            </div>
        @endif
    @else
        <div style="border: 1px solid black; height: 100px; width: 300px">
            <br><br>
            tidak ada mockup
        </div>
    @endif
    <br>
    <br>
    <table style="width: 100%; font-size: 12px">
        @php($product = $transactionList->product)
        <tr>
            <td style="width: 30% !important; vertical-align: top">
                <table class="table" style="width: 100%">
                    <tr class="table">
                        <td class="table">KAIN</td>
                        <td class="table">KET</td>
                        <td class="table">JUMLAH</td>
                    </tr>

                    @forelse($product->productMaterials->where('material.material_category_id','=',1) as $tl)
                        <tr class="table">
                            <td class="table">
                                {{$tl->material->title}}
                            </td>
                            <td class="table">{{ $tl->note }}</td>
                            <td class="table">{{ thousand_format($tl->amount) }} pcs</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Tidak ada kain yang dibutuhkan dalam produksi</td>
                        </tr>
                    @endforelse
                </table>
            </td>
            <td style="width: 3%"></td>

            <td style="width: 30% !important; vertical-align: top">
                <table class="table" style="width: 100%">
                    <tr class="table">
                        <td class="table">TALI</td>
                        <td class="table">KET</td>
                        <td class="table">JUMLAH</td>
                    </tr>
                    @forelse($product->productMaterials->where('material.material_category_id','=',2) as $tl)
                        <tr class="table">
                            <td class="table">
                                {{$tl->material->title}}
                            </td>
                            <td class="table">{{ $tl->note }}</td>
                            <td class="table">{{ thousand_format($tl->amount) }} pcs</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Tidak ada tali yang dibutuhkan dalam produksi</td>
                        </tr>
                    @endforelse
                </table>
            </td>
            <td style="width: 3%"></td>

            <td style="width: 30% !important; vertical-align: top">
                <table class="table" style="width: 100%">
                    <tr class="table">
                        <td class="table">AKSESORIS</td>
                        <td class="table">KET</td>
                        <td class="table">JUMLAH</td>
                    </tr>
                    @forelse($product->productMaterials->where('material.material_category_id','=',2) as $tl)
                        <tr class="table">
                            <td class="table">
                                {{$tl->material->title}}
                            </td>
                            <td class="table">{{ $tl->note }}</td>
                            <td class="table">{{ thousand_format($tl->amount) }} pcs</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Tidak ada aksesoris yang dibutuhkan dalam produksi</td>
                        </tr>
                    @endforelse
                </table>
            </td>
            <td style="width: 10px"></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td colspan="10">
                <div style="width: 100%; border: 1px solid black; height: 100px">
                    Catatan

                </div>
            </td>
        </tr>
    </table>


</div>
</body>
</html>
