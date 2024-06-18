<x-admin-layout>
    <x-slot name="title">
        Kehadiran {{ \App\Models\User::find($user)->name }}
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <livewire:attendance.attendance-show-user :user-id="$user"/>
            </div>
        </div>
    </div>
</x-admin-layout>
