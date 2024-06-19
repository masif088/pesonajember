<x-admin-layout>
    <x-slot name="title">
        Spatie tambah izin
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:spatie.permission-form action="create"/>
            </div>
        </div>
    </div>
</x-admin-layout>
