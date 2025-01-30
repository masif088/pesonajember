<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/><a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>
    <div>


        <livewire:order.order-preview :order-id="$id"/>
    </div>
</x-admin-layout>
