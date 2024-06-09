<x-admin-layout>
    <x-slot name="title">
        Buku Penjualan - Penjualan Selesai
    </x-slot>

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <livewire:table.master name="TransactionHistory"/>
            </div>
        </div>

</x-admin-layout>
