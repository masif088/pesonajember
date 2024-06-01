<x-admin-layout>
    <x-slot name="title">
        Ekspedisi Barang
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('shipper.create') }}" class="btn bg-wishka-600">Tambah Ekspedisi Barang</a>
                <br><br>
                <livewire:table.master name="Shipper"/>
            </div>
        </div>
    </div>
</x-admin-layout>
