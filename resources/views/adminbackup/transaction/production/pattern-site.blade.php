<x-admin-layout>
    <x-slot name="title">
        Production - Pola Site
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:table.production name="ProductionPattern"/>
            </div>
        </div>
    </div>
</x-admin-layout>
