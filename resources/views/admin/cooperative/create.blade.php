<x-admin-layout>
    <x-slot name="title">
        Koperasi
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:cooperative.cooperative-form action="create"/>
            </div>
        </div>
    </div>
</x-admin-layout>
