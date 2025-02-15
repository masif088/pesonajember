<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }} - {{ $data->user->name }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/><a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
            <livewire:salary.salary-form action="update" :data-id="$data->id" :index-path="$property['index']"/>
        </div>
    </div>
</x-admin-layout>
