<x-admin-layout>
    <x-slot name="title">
        {{ $property['main-title'] }} - {{ $transactionType->title }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route($property['index'],$id) }}">{{ $property['main-title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
            <x-button-custom title="Tambah Konsumen" href="{{ route('admin.customer.create') }}"/>
            <livewire:table.master name="OrderMargin" :param1="$transactionType->id"/>
        </div>
    </div>
</x-admin-layout>
