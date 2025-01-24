<x-admin-layout>
    <x-slot name="title">
        {{ $property['main-title'] }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route($property['index']) }}">{{ $property['main-title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
            <x-button-custom title="Tambah Supplier" href="{{ route('admin.supplier.create') }}"/>
            <livewire:table.master name="Supplier"/>
        </div>
    </div>
</x-admin-layout>
