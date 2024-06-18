<x-admin-layout>
    <x-slot name="title">
        Koperasi
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('cooperative.create') }}" class="btn bg-wishka-600">Tambah Data Koperasi</a>
                <br><br>
                <livewire:table.master name="Cooperative"/>
            </div>
        </div>
    </div>
</x-admin-layout>
