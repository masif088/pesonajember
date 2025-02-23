<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }}
{{--        <a href="{{ route('admin.order.preview',$id) }}" class="bg rounded text-nowrap px-4 py-2 bg-green-900 text-white float-right text-sm">Selesai</a>--}}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/><a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>
    <div>
        <livewire:order.order-sharing-percentage :order-id="$id"/>
    </div>
</x-admin-layout>
