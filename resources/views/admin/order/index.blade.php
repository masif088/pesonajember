@php use Carbon\Carbon; @endphp
@php use App\Models\Order; @endphp
<x-admin-layout>
    <x-slot name="title">
        {{ $property['main-title'] }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route($property['index']) }}">{{ $property['main-title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 grid grid-cols-12 gap-3">
            {{--            @for($i=0;$i<3;$i++)--}}
            <div class="lg:col-span-4 col-span-12">
                <div class="card">
                    <div class="card-body bg-gray-50 rounded flex gap-3 align-middle p-3">
                        <div class="bg-green-200 rounded-full my-auto"
                             style="width: 64px;height: 64px; padding: 20px 0">
                                <span class="iconify text-green-900 text-2xl mx-auto"
                                      data-icon="icon-park-solid:wallet"></span>
                        </div>
                        <div>
                            {{ month_name(Carbon::now()->month) }} {{ Carbon::now()->year }} <br>
                            <h6>Transaksi E Catalog</h6>
                            <h4 class="text-green-900 mb-3">{{ Order::where('transaction_type_id',2)->count() }}
                                Pesanan</h4>
                            <a href="{{ route('admin.order.create',2) }}"
                               class="bg-green-900 text-white px-2 py-1 rounded-lg mt-1">Input Pesanan</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 col-span-12">
                <div class="card">
                    <div class="card-body bg-gray-50 rounded flex gap-3 align-middle p-3">
                        <div class="bg-green-200 rounded-full my-auto"
                             style="width: 64px;height: 64px; padding: 20px 0">
                                <span class="iconify text-green-900 text-2xl mx-auto"
                                      data-icon="icon-park-solid:wallet"></span>
                        </div>
                        <div>
                            {{ month_name(Carbon::now()->month) }} {{ Carbon::now()->year }} <br>
                            <h6>Transaksi By Order</h6>
                            <h4 class="text-green-900 mb-3">{{ Order::where('transaction_type_id',1)->count() }}
                                Pesanan</h4>
                            <a href="{{ route('admin.order.create',1) }}"
                               class="bg-green-900 text-white px-2 py-1 rounded-lg mt-1">Input Pesanan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 col-span-12">
                <div class="card">
                    <div class="card-body bg-gray-50 rounded flex gap-3 align-middle p-3">
                        <div class="bg-green-200 rounded-full my-auto"
                             style="width: 64px;height: 64px; padding: 20px 0">
                                <span class="iconify text-green-900 text-2xl mx-auto"
                                      data-icon="icon-park-solid:wallet"></span>
                        </div>
                        <div>
                            {{ month_name(Carbon::now()->month) }} {{ Carbon::now()->year }} <br>
                            <h6>Transaksi Pinjam Bendera</h6>
                            <h4 class="text-green-900 mb-3">{{ Order::where('transaction_type_id',3)->count() }}
                                Pesanan</h4>
                            <a href="{{ route('admin.order.create',3) }}"
                               class="bg-green-900 text-white px-2 py-1 rounded-lg mt-1">Input Pesanan</a>
                        </div>
                    </div>
                </div>
            </div>
            {{--            @endfor--}}
            <div class="col-span-12">
                <livewire:table.master name="Order"/>
            </div>
        </div>
    </div>
</x-admin-layout>
