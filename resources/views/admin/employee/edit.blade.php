<x-admin-layout>
    <x-slot name="title">
        Bank
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:bank.bank-form action="update" :data-id="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
