<x-admin-layout>
    <x-slot name="title">
        Produk
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
{{--                <a href="route"></a>--}}
                <br>
{{--                <livewire:test/>--}}
                <livewire:product.product-form/>
                {{--                <livewire:table.master name="Product"/>--}}
            </div>
        </div>
    </div>
</x-admin-layout>
