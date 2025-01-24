<x-admin-layout>
    <x-slot name="title">
        Karyawan
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('employee.create') }}" class="btn bg-wishka-600">Tambah Karyawan</a>
                <br><br>
                <livewire:table.master name="User"/>
            </div>
        </div>
    </div>
</x-admin-layout>
