<x-admin-layout>
    <x-slot name="title">
        Kas kecil
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('finance.petty-cash.create') }}" class="btn bg-wishka-600">Tambah transaksi</a>
                <br><br>
                <livewire:finance.petty-cash/>
            </div>
        </div>
    </div>
</x-admin-layout>
