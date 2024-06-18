<x-admin-layout>
    <x-slot name="title">
        Kehadiran
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('attendance.create') }}" class="btn bg-wishka-600">Tambah Hari Libur</a>
                <br><br>
                <livewire:table.master name="AttendanceMaster"/>
            </div>
        </div>
    </div>
</x-admin-layout>
