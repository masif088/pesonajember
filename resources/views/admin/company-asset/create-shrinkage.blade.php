<x-admin-layout>
    <x-slot name="title">
        Asset perusahaan
    </x-slot>
    <div class="">
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:company-asset.company-asset-form action="create"/>
            </div>
        </div>
    </div>
</x-admin-layout>
