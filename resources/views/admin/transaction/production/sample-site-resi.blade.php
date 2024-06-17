<x-admin-layout>
    <x-slot name="title">
        Production - Sample Site
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:transaction.shipper-form :data-id="$id"  action="create" sample="1"/>
            </div>
        </div>
    </div>
</x-admin-layout>
