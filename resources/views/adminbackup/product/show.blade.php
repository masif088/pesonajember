<x-admin-layout>
    <x-slot name="title">
        Produk
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <livewire:product.product-detail :data-id="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
