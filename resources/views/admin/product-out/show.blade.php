<x-admin-layout>
    <x-slot name="title">
        {{ $property['main-title'] }} - {{ $order->order_number }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/>
        <a href="#" class="font-bold">{{ $order->order_number }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">

        <div class="col-span-12">
            <table>
                <tr style="height: 40px">
                    <td>Nama Konsumen</td>
                    <td style="width: 100px"></td>
                    <td>{{ $order->customer->name }}</td>
                </tr>
                <tr style="height: 40px">
                    <td>Nama Perusahaan</td>
                    <td style="width: 100px"></td>
                    <td>{{ $order->customer->company_name }}</td>
                </tr>
            </table>
            <br><br>
        </div>
        <div class="col-span-12">
            <a class="bg-green-900 text-white rounded px-4 py-2"
               href="{{ route('admin.product-out.create',[$id,$order->id]) }}">
                Tambah Barang Keluar dan Surat jalan
            </a>
        </div>
        <br>
        <div class="col-span-12">
            <table class="table w-full">
                <thead class="border-b-2 font-bold">
                <tr>
                    <td style="width: 170px">NO</td>
                    <td style="width: 300px">NOTE</td>
                    <td>PDF DOWNLOAD</td>
                    <td>AKSI</td>
{{--                    <td>KETERANGAN</td>--}}
                </tr>
                </thead>
                <tbody>

                @foreach($order->orderProductOuts as $opo)
                    <tr style="height: 100px;" class="border-b-2">
                        <td class="align-top py-2">
                            Nomer Barang Keluar: <br><b>{{ $opo->reference_number??'2025123kjansd/j' }}</b> <br>
                            Nomer Surat Jalan: <br><b>{{ $opo->reference_number??'2025123kjansd/j' }}</b>
                        </td>
                        <td class="align-top py-2">
                            {{ $opo->note }} <br>
                            Bukti Surat Jalan: <b>{{ $opo->proof_of_waybill!=null ?' SUDAH TERUPLOAD':'BELUM TERUPLOAD' }}</b><br>
                            Bukti Barang Keluar: <b>{{ $opo->proof_of_product_out!=null ?' SUDAH TERUPLOAD':'BELUM TERUPLOAD' }}</b><br>
                        </td>
                        <td class="align-top py-2">
                            <div class="flex">
                                <a href="{{ route('admin.product-out.download-product-out',[$id,$order->id,$opo->id]) }}"
                                   target="_blank"
                                   class="bg-pink-100 hover:bg-pink-200 rounded px-4 py-2 text-nowrap flex text-pink-900 mb-1">
                                    <span class="iconify text-pink-900 text-2xl"
                                          data-icon="material-symbols:download"></span>
                                    <span>Download Barang Keluar</span>
                                </a>
                            </div>
                            <div class="flex">
                                <a href="{{ route('admin.product-out.download-waybill',[$id,$order->id,$opo->id]) }}"
                                   target="_blank"
                                   class="bg-pink-100 hover:bg-pink-200 rounded px-4 py-2 text-nowrap flex text-pink-900">
                                    <span class="iconify text-2xl" data-icon="material-symbols:download"></span>
                                    <span>Download Surat Jalan</span>
                                </a>
                            </div>
                        </td>
                        <td class="align-top py-2">
                            <div class="flex">
                                <a href="{{ route('admin.product-out.upload',[$id,$order->id,$opo->id]) }}"
                                   class="bg-brown-100 hover:bg-brown-200 rounded px-4 py-2 text-nowrap flex text-brown-900 mb-1">
                                    <span class="iconify text-brown-900 text-2xl"
                                          data-icon="material-symbols:upload-rounded"></span>
                                    <span>Upload bukti</span>
                                </a>
                            </div>
                            <div class="flex">
                                <a href='{{ route('admin.product-out.edit',[$id,$order->id,$opo->id]) }}' class='bg-yellow-100 hover:bg-yellow-200 rounded px-4 py-2 text-nowrap flex text-yellow-900 mb-1 '>
                                    <span class='iconify text-yellow-900 text-2xl' data-icon='ic:baseline-edit'></span>
                                    <span> Edit</span>
                                </a>
                            </div>

                        </td>

                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
        <div class="col-span-12 mt-5">
            <h5 class="text-xl">LIST ORDER [{{ $order->order_number }}]</h5>
            <br>
            <table class="table w-full">
                <thead class="border-b-2 font-bold">
                <tr>
                    <td>No</td>
                    <td>Nama barang</td>
                    <td class="text-center">QTY Order</td>
                    <td class="text-center">QTY Terkirim</td>
                </tr>
                </thead>
                <tbody>
                @foreach($order->orderProducts as $index=>$op)
                    <tr style="height: 50px;" class="border-b-2">
                        <td class="align-top py-2">{{ $index+1 }}</td>
                        <td class="align-top py-2">{{ $op->name }}</td>
                        <td class="align-top py-2 text-center">{{ thousand_format($op->quantity) }}</td>
                        <td class="align-top py-2 text-center">{{ thousand_format($op->orderProductOutDetails->sum('quantity')) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
