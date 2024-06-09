<x-admin-layout>
    <x-slot name="title">
        Buku Penjualan - Penjualan Berjalan
    </x-slot>
<div>
    <div class="grid grid-cols-12">
        <br><br>
        <div class="col-span-12 grid grid-cols-12 gap-3">
            <x-argon.show-data title="Nama Lengkap" content="{{ \App\Models\Transaction::find($id)->customer->name }}"/>
            <x-argon.show-data title="Alamat" content="{{ !is_null(\App\Models\Transaction::find($id)->customer->address)?\App\Models\Transaction::find($id)->customer->address:'-' }}"/>

            <x-argon.show-data title="No. Telepon" content="{{ \App\Models\Transaction::find($id)->customer->phone }}"/>
            <x-argon.show-data title="Email" content="{{ \App\Models\Transaction::find($id)->customer->email }}"/>

            <x-argon.show-data title="Tanggal Transaksi" content="{{ \App\Models\Transaction::find($id)->created_at->format('Y-m-d') }}"/>
            <x-argon.show-data title="Nomer Pesanan" content="{{ \App\Models\Transaction::find($id)->uid }}"/>
        </div>
{{--        {{ \App\Models\Transaction::find($id)->customer }}--}}

    </div>
    <br>
    <hr>
    <br>
    <div class="grid grid-cols-12 gap-3">

        <div class="col-span-12">
            <livewire:finance.transaction-payment action="create"  :transaction-id="$id"/>
        </div>
    </div>
</div>


</x-admin-layout>
