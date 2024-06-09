<x-admin-layout>
    <x-slot name="title">
        Buku Penjualan - Detail Transaksi
    </x-slot>
<div>
    <div class="grid grid-cols-12 gap-3">
        <br><br>
        <div class="col-span-12">
            <livewire:transaction.transaction-detail :data-id="$id" />
        </div>
    </div>
</div>


</x-admin-layout>
