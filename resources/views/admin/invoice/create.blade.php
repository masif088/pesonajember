<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route($property['index'],$id) }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/><a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
            <livewire:invoice.invoice-form action="create" :partner-id="$id" :order-id="$orderId" />
        </div>
    </div>
</x-admin-layout>
