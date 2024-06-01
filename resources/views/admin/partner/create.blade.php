<x-admin-layout>
    <x-slot name="title">
        Partner
    </x-slot>
    <div class="">
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:partner.partner-form action="create"/>
            </div>
        </div>
    </div>
</x-admin-layout>
