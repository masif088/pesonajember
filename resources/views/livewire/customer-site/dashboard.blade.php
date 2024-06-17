<div class="text-wishka-600 lg:grid grid-cols-12 col-span-12">
    <div class="col-span-12 mb-3">
        <h2 class='text-2xl mb-3'>Selamat Datang,</h2>
        <h2 class='text-2xl'>{{ $customer->name??"User tidak diketahui" }}</h2>
    </div>
    <div class="col-span-6 text-white mb-3">
        <div class="bg-primary px-5 py-3 rounded-md lg:flex justify-between align-middle">
            <div class="py-1">Hai kak {{ $customer->name }} ada mockup yang perlu anda setujui</div>
            <a href="" class="px-2 py-1 rounded-md bg-success text-nowrap">Klik disini</a>
        </div>
    </div>
    <div class="col-span-12  lg:grid grid-cols-12 gap-3  ">

        <div class="col-span-3 mb-3">
            <div class="card ">
                <div class="card-body">
                    <div class="flex justify-between">
                        <div class="flex justify-center items-center w-14 h-[50px] bg-wishka-200 rounded-md">
                            <i class="ti ti-basket text-3xl text-wishka-600"></i>
                        </div>
                        <div class="text-end">
                            <h5 class="card-title">{{ $customer->transactions->count() }}</h5>
                            <p class="font-medium">Pesanan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-3 mb-3">
            <div class="card ">
                <div class="card-body">
                    <div class="flex justify-between">
                        <div class="flex justify-center items-center w-14 h-[50px] bg-wishka-200 rounded-md">
                            <i class="ti ti-progress-down text-3xl text-wishka-600"></i>
                        </div>
                        <div class="text-end">
                            <h5 class="card-title">{{ $customer->transactions->count() }}</h5>
                            <p class="font-medium">Pesanan Berjalan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-3 mb-3">
            <div class="card ">
                <div class="card-body">
                    <div class="flex justify-between">
                        <div class="flex justify-center items-center w-14 h-[50px] bg-wishka-200 rounded-md">
                            <i class="ti ti-checklist text-3xl text-wishka-600"></i>
                        </div>
                        <div class="text-end">
                            <h5 class="card-title">{{ $customer->transactions->count() }}</h5>
                            <p class="font-medium">Pesanan Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-3 mb-3">
            <div class="card ">
                <div class="card-body">
                    <div class="flex justify-between">
                        <div class="flex justify-center items-center w-14 h-[50px] bg-wishka-200 rounded-md">
                            <i class="ti ti-basket-cancel text-3xl text-wishka-600"></i>
                        </div>
                        <div class="text-end">
                            <h5 class="card-title">{{ $customer->transactions->count() }}</h5>
                            <p class="font-medium">Pesanan Dibatalkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="col-span-12">
        <br>
        <h2>RIWAYAT TRANSAKSI BERSAMA WISHKA</h2>
        <br>
        <div class="overflow-x-auto">
            <table
                class="border-collapse border-wishka-400 w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded table-auto">
                <thead
                    class=" text-md text-uppercase text-gray-700 uppercase dark:bg-dark dark:text-white text-bold text-center">
                <tr class="border-b-[3px] border-wishka-400 border-collapse text-xs">
                    <td class="py-2 px-2 font-extralight">Pesanan</td>
                    <td class="py-2 px-2 font-extralight">Nominal Transaksi</td>
                    <td class="py-2 px-2 font-extralight">Proses</td>
                    <td class="py-2 px-2 font-extralight">Detail</td>
                </tr>
                </thead>
                <tbody>
                @foreach($customer->transactions as $c)
                    @php
                        $total = 0;
                        foreach ($c->transactionLists as $tl) {
                            if ($tl->transaction_detail_type_id == 1) {
                                $total += $tl->price;
                            } else {
                                $total += ($tl->price * $tl->amount);
                            }
                        }
                    @endphp

                    <tr class=" dark:text-white text-black border-b border-gray-200 text-xs ">
                        <td class="py-2 px-2 font-extralight">
                            {{ $c->uid }} <br>{{ $c->created_at->format('d-M-Y') }}
                        </td>
                        <td class="py-2 px-2 font-extralight text-center">
                            Rp.
                            {{ thousand_format($total) }}
                        </td>

                        <td class="py-2 px-2 font-extralight " style="width: 150px">
                            {{ $c->transactionStatus->transactionStatusType->title??'' }}
                        </td>

                        <td class="py-2 px-2 font-extralight text-center">
                            <div class="flex gap-2 text-center justify-center">
                                <a href='{{ route('customer.customer-transaction-production',[$hash,$c->id]) }}'
                                   class='py-1 px-2 bg-secondary text-white rounded-lg text-xl'>
                                    <i class='ti ti-eye'></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
