<x-admin-layout>
    <x-slot name="title">
        Gaji Karyawan
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('salary.create') }}" class="btn bg-wishka-600">Tambah Gaji Karyawan</a>
                <br><br>
                <livewire:table.master name="Salary"/>
            </div>
        </div>
    </div>
</x-admin-layout>
