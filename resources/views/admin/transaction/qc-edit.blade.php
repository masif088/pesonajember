<x-admin-layout>
    <x-slot name="title">
        Input QC
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">

                <br>
                <livewire:transaction.qc-form :data-id="$id"  action="create"/>
            </div>
        </div>
    </div>
</x-admin-layout>
