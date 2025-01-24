<x-admin-layout>
    <x-slot name="title">
        Produk
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:product.product-form :data-id="$id" action="update"/>
            </div>
        </div>
    </div>
</x-admin-layout>
