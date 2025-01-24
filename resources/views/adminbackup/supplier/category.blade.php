<x-admin-layout>
    <x-slot name="title">
        Kategori Suplier
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('supplier.category.create') }}" class="btn bg-wishka-600">Tambah Kategori Supplier</a>
                <br><br>
                <livewire:table.master name="SupplierCategory"/>
            </div>
        </div>
    </div>
</x-admin-layout>
