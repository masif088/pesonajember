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
                <tr style="height: 40px">
                    <td>Total Pembayaran sekarang</td>
                    <td style="width: 100px"></td>
                    <td>Rp. {{ thousand_format($order->orderProofOfCashes->sum('nominal')) }}</td>
                </tr>
            </table>
            <br><br>
        </div>
        <div class="col-span-12">
            <a class="bg-green-900 text-white rounded px-4 py-2"
               href="{{ route('admin.proof-of-cash.create',[$id,$order->id]) }}">
                Tambah Kwitansi / Pembayaran Baru
            </a>
        </div>
        <br>
        <div class="col-span-12">
{{--            <a href="{{ route('admin.order.proof-of-cash.create',$orderId) }}"--}}
{{--               class="bg-green-100 hover:bg-green-200 text-green-900 px-5 py-2 rounded text-center"--}}
{{--               style="width: 100px">--}}
{{--                Tambah Kwitansi / Pembayaran Baru--}}
{{--            </a>--}}
            <br><br>
            <table class="table w-full">
                <thead>
                <tr class="border-b" style="height: 50px">
                    <td>Tanggal</td>
                    <td>Partner/CV <br>yang Mengeluarkan</td>
                    <td>Invoice Number</td>
                    <td>Note</td>
                    <td>Pemesan</td>
                    <td>Nominal</td>
                    <td class="text-center">Aksi</td>
                </tr>
                </thead>
                <tbody>
                @foreach($order->orderInvoices as $poc)
                    @if($poc->partner_id == $id)
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
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
