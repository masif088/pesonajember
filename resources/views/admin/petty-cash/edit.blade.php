<x-admin-layout>
    <x-slot name="title">
        Kas kecil
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:finance.petty-cash-from action="update" :data-id="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
