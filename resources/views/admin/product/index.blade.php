<x-admin-layout>
    <x-slot name="title">
        Produk
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('production.create') }}" class="btn bg-wishka-600">Tambah Produk</a>
                <br><br>

                <livewire:table.master name="Product"/>
            </div>
        </div>
    </div>
</x-admin-layout>
