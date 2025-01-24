<x-admin-layout>
    <x-slot name="title">
        Kategori Material
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('material.category.create') }}" class="btn bg-wishka-600">Tambah Kategori Material</a>
                <br><br>
                <livewire:table.master name="MaterialCategory"/>
            </div>
        </div>
    </div>
</x-admin-layout>
