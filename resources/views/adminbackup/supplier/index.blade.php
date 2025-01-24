<x-admin-layout>
    <x-slot name="title">
        Suplier
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('supplier.create') }}" class="btn bg-wishka-600">Tambah Supplier</a>
                <br><br>
                <livewire:table.master name="Supplier"/>
            </div>
        </div>
    </div>
</x-admin-layout>
