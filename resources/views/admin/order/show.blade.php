@php use App\Models\OrderSharingDetail; @endphp
<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/>
        <a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 grid grid-cols-12 gap-3">
            <div class="card col-span-12 border">
                <div class="card-body">
                    @php
                        $ppn = $data->ppn;
                        $pph = 1.5;

                        $afterTax = 0;


        $allSharing= 0;
        foreach ($data->orderProducts as $item2){
            $afterTax += getTax($item2->value,$ppn,$item2->pph);;
            foreach ($data->orderSharings as $s){
                $osd = OrderSharingDetail::where('order_sharing_id', $s->id)->where('order_product_id', $item2->id)->first();
                if ($osd != null) {
                    $allSharing += $osd->percentage*getTax(($item2->price * $item2->quantity),$ppn,$item2->pph)/100;
                }
            }
        }


                        $total = $data->orderProducts->sum('value');
                        $totalHpp = $data->orderProducts->sum('hpp_value');
                        $totalNominal = $data->orderProofOfCashes->sum('nominal');
//                            $dpp =$total*100/(100+$ppn);
//                            $ppnProduct = $total - $dpp;
//                            $pphProduct = $pph*$dpp/100;
//                            $afterTax = $afterTax;
                            $statuses = ['Draft','Aktif','Cancel','Selesai'];

                                $recaps = [
                                  ['title'=>'No Transaksi','value'=>$data->order_number],
                                  ['title'=>'Nama Konsumen','value'=>$data->customer->name],
                                  ['title'=>'Nama Perusahaan','value'=>$data->customer->company_name],
                                  ['title'=>'Nominal Keseluruhan Kontrak','value'=>'Rp. '.thousand_format($total)],
                                  ['title'=>'Nominal Keseluruhan Setelah Pajak','value'=>'Rp. '. thousand_format($afterTax)],
                                  ['title'=>'Nominal Keseluruhan HPP','value'=>'Rp. '.thousand_format($totalHpp)],
                                  ['title'=>'Nominal Sharing','value'=>'Rp. '. thousand_format($allSharing)],
                                  ['title'=>'Nominal Margin Profit','value'=>'Rp. '. thousand_format(($afterTax-$allSharing-$totalHpp)).' ('.number_format(($afterTax-$allSharing-$totalHpp)/$afterTax*100,2,',','.')."%)"],
                                  ['title'=>'Telah terbayar','value'=>'Rp. '. thousand_format(($totalNominal))],
                                  ['title'=>'Status Transaksi','value'=>"<b class='font-bold'>{$statuses[$data->status]}</b>"],
                                ];
                    @endphp

                    <table class=" w-full">
                        @foreach($recaps as $recap)
                            <tr style="height: 50px">
                                <td style="width: 25% !important;">{{ $recap['title'] }}</td>
                                <td class="px-5 p-2">:</td>
                                <td class="w-full">
                                    <div class="bg-gray-200 px-5 py-2 rounded ">
                                        {!! $recap['value'] !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                            <tr style="height: 50px">
                                <td style="width: 25% !important;">Kwitansi / Pembayaran</td>
                                <td class="px-5 p-2">:</td>
                                <td class="">
                                    <a href="{{ route('admin.order.proof-of-cash.create',$data->id) }}"
                                        class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center"
                                        style="width: 100px">
                                        Tambah Kwitansi / Pembayaran Baru
                                    </a>
                                </td>
                            </tr>
{{--                        <tr style="height: 50px">--}}
{{--                            <td style="width: 25% !important;">Surat Jalan</td>--}}
{{--                            <td class="px-5 p-2">:</td>--}}
{{--                            <td class="">--}}
{{--                                <a href="{{ route('prod') }}"--}}
{{--                                    class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center"--}}
{{--                                    style="width: 100px">--}}
{{--                                    Lihat--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr style="height: 50px">--}}
{{--                            <td style="width: 25% !important;">Bukti Barang Keluar</td>--}}
{{--                            <td class="px-5 p-2">:</td>--}}
{{--                            <td class="">--}}
{{--                                <div--}}
{{--                                    class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center"--}}
{{--                                    style="width: 100px">--}}
{{--                                    Lihat--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr style="height: 50px">--}}
{{--                            <td style="width: 25% !important;">Rekap Pembayaran</td>--}}
{{--                            <td class="px-5 p-2">:</td>--}}
{{--                            <td class="">--}}
{{--                                <div--}}
{{--                                    class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center"--}}
{{--                                    style="width: 100px">--}}
{{--                                    Lihat--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                    </table>
                </div>
            </div>
        </div>

            <livewire:order.order-show-detail-transaction :order-id="$data->id"/>



    </div>
</x-admin-layout>
