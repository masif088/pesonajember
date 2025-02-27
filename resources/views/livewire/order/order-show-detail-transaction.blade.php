<div class="col-span-12 grid grid-cols-12 gap-3">
    <div class="card col-span-12 border">
        <div class="card-body">
            <div class="card-title flex justify-between">
                <span>
                    Detail Transaksi
                </span>
                @if($open[0])
                    <span wire:click="openAndClose(0)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded float-right"
                          data-icon="iconamoon:arrow-up-2-bold"></span>
                @else
                    <span wire:click="openAndClose(0)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded  float-right"
                          data-icon="iconamoon:arrow-down-2-bold"></span>
                @endif
            </div>

            @if($open[0])
                <br>
                <hr>
                <br>
                <livewire:order.order-preview-details :order-id="$orderId" :sharing="true"/>
            @endif
        </div>
    </div>
    <div class="card col-span-12 border">
        <div class="card-body">
            <div class="card-title flex justify-between">
                <span>
                    Kwitansi / Pembayaran
                </span>
                @if($open[1])
                    <span wire:click="openAndClose(1)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded float-right"
                          data-icon="iconamoon:arrow-up-2-bold"></span>
                @else
                    <span wire:click="openAndClose(1)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded  float-right"
                          data-icon="iconamoon:arrow-down-2-bold"></span>
                @endif
            </div>

            @if($open[1])
                <br>
                <hr>
                <br>
                <a href="{{ route('admin.order.proof-of-cash.create',$orderId) }}"
                   class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center float-right">
                    Tambah Kwitansi / Pembayaran Baru
                </a>
                <br><br>
                <table class="table w-full">
                    <thead>
                    <tr class="border-b" style="height: 50px">
                        <td>Tanggal</td>
                        <td>Partner/CV <br>yang Mengeluarkan</td>
                        <td>Note</td>
                        <td>Pemesan</td>
                        <td>Nominal</td>
                        <td class="text-center">Aksi</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderProofOfCashes as $poc)
                        <tr style="height: 50px">
                            <td>{{ Carbon\Carbon::parse($poc->created_at)->format('d/m/y H:i') }}</td>
                            <td>{{ $poc->partner->name??'' }}</td>
                            <td>{{ $poc->note }}</td>
                            <td>{{ $poc->pic }}</td>
                            <td>
                                <div class="flex justify-between">
                                    <span>Rp. </span>
                                    <span>{{ thousand_format($poc->nominal) }}</span>
                                </div>
                            </td>
                            <td>
                                <div class='text-xl flex gap-1 justify-center'>
                                    <a href='{{ route('admin.order.proof-of-cash.edit',[$orderId,$poc->id]) }}'
                                       class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                                        <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                                    </a>
                                    <a href='{{ route('admin.order.download.proof-of-cash',[$orderId,$poc->id]) }}'
                                       class='p-2 bg-green-100 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                                        <span class='iconify text-green-900' data-icon='lsicon:view-filled'></span>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card col-span-12 border">
        <div class="card-body">

            <div class="card-title flex justify-between">
                <span>
                    Mockup
                </span>
                @if($open[2])
                    <span wire:click="openAndClose(2)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded float-right"
                          data-icon="iconamoon:arrow-up-2-bold"></span>
                @else
                    <span wire:click="openAndClose(2)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded  float-right"
                          data-icon="iconamoon:arrow-down-2-bold"></span>
                @endif
            </div>

            @if($open[2])
                <br>
                <hr>
                <br>
                <a href="{{ route('admin.order.create-mockup',$orderId) }}"
                   class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center float-right">
                    Tambah Mockup
                </a>
                <br><br>
                <table class="table w-full">
                    <thead>
                    <tr class="border-b" style="height: 50px">
                        <td>No</td>
                        <td>Judul</td>
                        <td>Download</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderMockups as $index=>$poc)
                        <tr style="height: 50px" class="border-b">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $poc->title }}</td>
                            <td>
                                <div class='flex'>
                                    <a href='{{ route('admin.order.download-mockup',[$orderId,$poc->id]) }}'
                                       target='_blank'
                                       class='bg-pink-100 hover:bg-pink-200 rounded px-4 py-2 text-nowrap flex text-pink-900'>
                                    <span class='iconify text-pink-900 text-2xl'
                                          data-icon='material-symbols:download'></span>
                                        <span>Download</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>


    <div class="card col-span-12 border">
        <div class="card-body">

            <div class="card-title flex justify-between">
                <span>
                    Barang Keluar
                </span>
                @if($open[3])
                    <span wire:click="openAndClose(3)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded float-right"
                          data-icon="iconamoon:arrow-up-2-bold"></span>
                @else
                    <span wire:click="openAndClose(3)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded  float-right"
                          data-icon="iconamoon:arrow-down-2-bold"></span>
                @endif
            </div>

            @if($open[3])
                <br>
                <hr>
                <br>
{{--                <a href="{{ route('admin.order.create-mockup',$orderId) }}"--}}
{{--                   class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center float-right">--}}
{{--                    Tambah Mockup--}}
{{--                </a>--}}
{{--                <br><br>--}}
                <table class="table w-full">
                    <thead>
                    <tr class="border-b" style="height: 50px">
                        <td>No</td>
                        <td>CV/Partner yang mengeluarkan</td>
                        <td>Note</td>
                        <td>Download</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderProductOuts as $index=>$opo)
                        <tr style="height: 50px" class="border-b">
                            <td>
                                Nomer Barang Keluar: <br><b>{{ $opo->reference_product_out??'-' }}</b> <br>
                                Nomer Surat Jalan: <br><b>{{ $opo->reference_waybill??'-' }}</b>
                            </td>
                            <td>{{ $opo->partner->name }}</td>
                            <td>
                                {{ $opo->note }} <br>
                                Bukti Surat Jalan:
                                @if($opo->proof_of_waybill)
                                    <a href="{{ route('admin.download-file',base64_encode($opo->proof_of_waybill)) }}" class="text-green-900">
                                        <b>SUDAH TERUPLOAD</b>
                                    </a>
                                @else
                                    BELUM TERUPLOAD
                                @endif

                                <br>
                                Bukti Barang Keluar:
                                @if($opo->proof_of_product_out)
                                    <a href="{{ route('admin.download-file',base64_encode($opo->proof_of_product_out)) }}" class="text-green-900">
                                        <b>SUDAH TERUPLOAD</b>
                                    </a>
                                @else
                                    BELUM TERUPLOAD
                                @endif

                                <br>
                            </td>
                            <td>
                                <div class="flex">
                                    <a href="{{ route('admin.product-out.download-product-out',[$opo->partner_id,$order->id,$opo->id]) }}"
                                       target="_blank"
                                       class="bg-pink-100 hover:bg-pink-200 rounded px-4 py-2 text-nowrap flex text-pink-900 mb-1">
                                    <span class="iconify text-pink-900 text-2xl"
                                          data-icon="material-symbols:download"></span>
                                        <span>Download Barang Keluar</span>
                                    </a>
                                </div>
                                <div class="flex">
                                    <a href="{{ route('admin.product-out.download-waybill',[$opo->partner_id,$order->id,$opo->id]) }}"
                                       target="_blank"
                                       class="bg-pink-100 hover:bg-pink-200 rounded px-4 py-2 text-nowrap flex text-pink-900">
                                        <span class="iconify text-2xl" data-icon="material-symbols:download"></span>
                                        <span>Download Surat Jalan</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card col-span-12 border">
        <div class="card-body">

            <div class="card-title flex justify-between">
                <span>
                    Rekap Pembayaran
                </span>
                @if($open[4])
                    <span wire:click="openAndClose(4)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded float-right"
                          data-icon="iconamoon:arrow-up-2-bold"></span>
                @else
                    <span wire:click="openAndClose(4)"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded  float-right"
                          data-icon="iconamoon:arrow-down-2-bold"></span>
                @endif
            </div>

            @if($open[4])
                <br>
                <hr>
                <br>
                {{--                <a href="{{ route('admin.order.create-mockup',$orderId) }}"--}}
                {{--                   class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center float-right">--}}
                {{--                    Tambah Mockup--}}
                {{--                </a>--}}
                {{--                <br><br>--}}
                <table class="table w-full">
                    <thead>
                    <tr class="border-b" style="height: 50px">
                        <td>Tanggal</td>
                        <td>Partner/CV <br>yang Mengeluarkan</td>
                        <td>Kwitansi Number</td>
                        <td>Note</td>
                        <td>Pemesan</td>
                        <td>Nominal</td>
                        <td class="text-center">Aksi</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderProofOfCashes as $poc)

                            <tr style="height: 50px">
                                <td>{{ Carbon\Carbon::parse($poc->created_at)->format('d/m/y H:i') }}</td>
                                <td>{{ $poc->partner->name??'' }}</td>
                                <td>{{ $poc->proof_of_cash_number }}</td>
                                <td>{{ $poc->note }}</td>
                                <td>{{ $poc->pic }}</td>
                                <td>
                                    <div class="flex justify-between">
                                        <span>Rp. </span>
                                        <span>{{ thousand_format($poc->nominal) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class='text-xl flex gap-1 justify-center'>
                                        <a href='{{ route('admin.order.proof-of-cash.edit',[$order->id,$poc->id]) }}' class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                                            <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                                        </a>
                                        <a href='{{ route('admin.order.download.proof-of-cash',[$order->id,$poc->id]) }}' class='p-2 bg-green-100 hover:bg-green-200 text-white rounded-sm transition-[opacity,margin]'>
                                            <span class='iconify text-green-900' data-icon='lsicon:view-filled'></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>
