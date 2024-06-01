<x-admin-layout>
    <x-slot name="title">
        Transaksi - Penagihan
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:transaction.billing-page :data-id="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
