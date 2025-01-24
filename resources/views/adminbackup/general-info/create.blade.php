<x-admin-layout>
    <x-slot name="title">
        Informasi Umum
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:general-info.general-info-form action="create"/>
            </div>
        </div>
    </div>
</x-admin-layout>
