<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }} - {{ $data->name }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/>
        <a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
        <livewire:wallet.wallet-transaction :data-id="$data->id"/>

        </div>
    </div>
</x-admin-layout>
