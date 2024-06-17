<x-admin-layout>
    <x-slot name="title">
        Nama Account
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <livewire:finance.account-name-form action="update" :data-id="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
