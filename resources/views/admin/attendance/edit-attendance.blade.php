<x-admin-layout>
    <x-slot name="title">
        Kehadiran
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <livewire:attendance.attendance-edit action="update" :data-id="$attendanceId" :master="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
