<x-admin-layout>
    <x-slot name="title">
        Partner
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('partner.create') }}" class="btn bg-wishka-600">Tambah Partner</a>
                <br><br>
                <livewire:table.master name="Partner"/>
            </div>
        </div>
    </div>
</x-admin-layout>
