<x-admin-layout>
    <x-slot name="title">
        Proses Produksi
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">

                <br>
                <livewire:transaction.production :active-tab="$tab"/>
{{--                <livewire:selling-tab/>--}}
            </div>
        </div>
    </div>
</x-admin-layout>
