<x-admin-layout>
    <x-slot name="title">
        PIC untuk proses yang sekarang
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <livewire:table.master name="ProductionPicList" :param1="$id"  action="create"/>
            </div>
        </div>
    </div>
</x-admin-layout>
