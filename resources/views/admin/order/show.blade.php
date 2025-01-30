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
            <div class="card col-span-12 shadow-none border">
                <div class="card-body">
                    @php
                        $ppn = 11;
                        $pph = 1.5;
                        $total = $data->orderProducts->sum('value');
                            $dpp =$total*100/(100+$ppn);
                            $ppnProduct = $total - $dpp;
                            $pphProduct = $pph*$dpp/100;
                            $afterTax = $dpp - $pphProduct;
                            $statuses = ['Draft','Aktif','Cancel','Selesai'];

                                $recaps = [
                                  ['title'=>'No Transaksi','value'=>$data->order_number],
                                  ['title'=>'Nama Konsumen','value'=>$data->customer->name],
                                  ['title'=>'Nama Perusahaan','value'=>$data->customer->company_name],
                                  ['title'=>'Nominal Keseluruhan Kontrak','value'=>'Rp. '.thousand_format($total)],
                                  ['title'=>'Nominal Keseluruhan Setelah Pajak','value'=>'Rp. '. thousand_format($afterTax)],
                                  ['title'=>'Margin profit','value'=>'Rp. '],
                                  ['title'=>'Status Transaksi','value'=>"<b class='font-bold'>{$statuses[$data->status]}</b>"],
                                ];
                    @endphp

                    <table class="font-light w-full">
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
                            <td style="width: 25% !important;">Surat Jalan</td>
                            <td class="px-5 p-2">:</td>
                            <td class="">
                                <div
                                    class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center"
                                    style="width: 100px">
                                    Lihat
                                </div>
                            </td>
                        </tr>
                        <tr style="height: 50px">
                            <td style="width: 25% !important;">Bukti Barang Keluar</td>
                            <td class="px-5 p-2">:</td>
                            <td class="">
                                <div
                                    class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center"
                                    style="width: 100px">
                                    Lihat
                                </div>
                            </td>
                        </tr>
                        <tr style="height: 50px">
                            <td style="width: 25% !important;">Rekap Pembayaran</td>
                            <td class="px-5 p-2">:</td>
                            <td class="">
                                <div
                                    class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center"
                                    style="width: 100px">
                                    Lihat
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-span-12 grid grid-cols-12 gap-3">
            <livewire:order.order-show-detail-transaction :order-id="$data->id"/>


        </div>
    </div>
</x-admin-layout>
