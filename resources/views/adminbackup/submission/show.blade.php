<x-admin-layout>
    <x-slot name="title">
        Stock Material
    </x-slot>
    <div class="">
        <br>
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">

                <livewire:material.material-stock :dataId="$id" />

            </div>
        </div>
    </div>
</x-admin-layout>
