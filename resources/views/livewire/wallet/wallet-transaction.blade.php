<div class="grid grid-cols-12 gap-3">
    <div class="col-span-12">
        <a href="{{ route('admin.wallet.create-transaction',[$dataId]) }}" class="rounded px-4 py-2 bg-green-900 text-white">Tambah Transaksi</a>
        <br><br>
    </div>
    <h2 class="col-span-12 text-center text-xl">
        Catatan {{ $wallet->name }} {{ month_name($month) }} {{ $year }}
    </h2>

    <div class="col-span-12 rounded-full bg-green-100 text-green-900 py-3 px-10 flex justify-between align-middle">
        <span class="px-3" wire:click="prevMonth">
            <span class='iconify text-2xl' data-icon='weui:arrow-filled' style="transform: rotate(180deg)"></span>
        </span>
        <span class="font-bold text-md"> {{ month_name($month) }} {{ $year }} </span>
        <span class="px-3" wire:click="nextMonth">
            <span class='iconify text-2xl' data-icon='weui:arrow-filled'></span>
        </span>
    </div>

    <div class="col-span-12 overflow-auto">
        <table class="table w-full table-responsive">
            <thead class="font-bold">
            <tr class="border-b" style="height: 50px">
                <td style="min-width: 50px">#</td>
                <td style="min-width: 100px">Tanggal</td>
                <td style="min-width: 200px">Keterangan</td>
                <td style="min-width: 200px" class="text-center">
                    Debet
                </td>
                <td style="min-width: 200px" class="text-center">
                    Kredit
                </td>
                <td style="min-width: 200px" class="text-center">
                    Saldo
                </td>
                <td style="min-width: 200px" class="text-center">
                    Tindakan
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($walletTransactions as $index=>$wt)
                <tr class="border-b" style="height: 50px">
                    <td>{{ $index+1 }}</td>
                    <td>{{ $wt->date }}</td>
                    <td>{{ $wt->description }}</td>
                    <td class="px-4">
                        <div class="flex justify-between">
                            <span>Rp. </span>
                            <span>{{ thousand_format($wt->debit) }}</span>
                        </div>
                    </td>
                    <td class="px-4">
                        <div class="flex justify-between">
                            <span>Rp. </span>
                            <span>{{ thousand_format($wt->credit) }}</span>
                        </div>
                    </td>
                    <td class="px-4">
                        <div class="flex justify-between">
                            <span>Rp. </span>
                            <span>{{ thousand_format($this->getSaldo($wt->id)) }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="flex justify-center gap-2">
                            <a href='{{ route('admin.wallet.edit-transaction',[$dataId,$wt->id]) }}' class='p-2 bg-yellow-100 hover:bg-yellow-200 text-white rounded-sm transition-[opacity,margin]'>
                                <span class='iconify text-yellow-900' data-icon='ic:baseline-edit'></span>
                            </a>
                            <a href='#' wire:click="deleteItem({{$wt->id}})" class='p-2 bg-red-200 hover:bg-red-100 text-white rounded-sm transition-[opacity,margin]'>
                                <span class='iconify text-red-900' data-icon='mingcute:delete-fill'></span>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
