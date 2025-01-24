<x-admin-layout>
    <x-slot name="title">
        Kategori Produk
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('production.category.create') }}" class="btn bg-wishka-600">Tambah Kategori Produk</a>
                <br><br>
                <livewire:table.master name="ProductCategory"/>
            </div>
        </div>
    </div>
</x-admin-layout>
