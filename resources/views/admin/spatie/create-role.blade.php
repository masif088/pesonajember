<x-admin-layout>
    <x-slot name="title">
        Spatie tambah role
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:spatie.role-form action="create"/>
            </div>
        </div>
    </div>
</x-admin-layout>
