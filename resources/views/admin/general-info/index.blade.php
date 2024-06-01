<x-admin-layout>
    <x-slot name="title">
        Informasi Umum
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('general-info.create') }}" class="btn bg-wishka-600">Tambah Informasi Umum</a>
                <br><br>
                <livewire:table.master name="GeneralInfo"/>
            </div>
        </div>
    </div>
</x-admin-layout>
