<x-admin-layout>
    <x-slot name="title">
        Production - Mockup Site
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:table.production name="ProductionMockup"/>
            </div>
        </div>
    </div>
</x-admin-layout>
