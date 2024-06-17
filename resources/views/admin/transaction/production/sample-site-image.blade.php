<x-admin-layout>
    <x-slot name="title">
        Production - Sample Site
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:transaction.mockup-form :data-id="$id" sample="1"/>
            </div>
        </div>
    </div>
</x-admin-layout>
