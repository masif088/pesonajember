<x-admin-layout>

    <x-slot name="title">
        Dashboard
    </x-slot>
    <div class="">
{{--        <livewire:table.master name="User"/>--}}
        <div class="grid grid-cols-12 gap-3">
            <x-argon.form-generator repositories="PartnerCategory"/>
        </div>
    </div>
</x-admin-layout>
