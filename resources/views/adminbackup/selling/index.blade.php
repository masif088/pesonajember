<x-admin-layout>

    <x-slot name="title">
        Dashboard
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
{{--                <livewire:material.material-list/>--}}
                {{--                <livewire:production.add-product/>--}}
                                <livewire:selling-tab/>
                {{--                            <x-argon.form-generator repositories="PartnerCategory"/>--}}
            </div>
        </div>
    </div>
</x-admin-layout>
