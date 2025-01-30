<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/>
        <a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>

    <livewire:product-out.product-out-form :partner-id="$id" :order-id="$orderId" :out-id="$outId" action="update"/>

</x-admin-layout>
