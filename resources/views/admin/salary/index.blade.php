<x-admin-layout>
    <x-slot name="title">
        {{ $property['main-title'] }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route($property['index']) }}">{{ $property['main-title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
            <x-button-custom title="Tambah Data Gaji" href="{{ route('admin.salary.create') }}"/>
            <livewire:table.master name="Salary"/>
        </div>
    </div>
</x-admin-layout>
