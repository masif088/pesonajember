<x-admin-layout>
    <x-slot name="title">
        Mutasi status
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:mutation-status.mutation-status-form action="update" :data-id="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
