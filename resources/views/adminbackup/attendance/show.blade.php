<x-admin-layout>
    <x-slot name="title">
        Kehadiran {{ \App\Models\AttendanceMaster::find($id)->attendance_date }}
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
{{--                <br><br>--}}
{{--                <a href="{{ route('attendance.create') }}" class="btn bg-wishka-600">Tambah Tanggal Kehadiran</a>--}}
                <br><br>
                <livewire:attendance.attendance-show :attendance-id="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
