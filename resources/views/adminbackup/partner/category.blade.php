<x-admin-layout>
    <x-slot name="title">
        Kategori Partner
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('partner.category.create') }}" class="btn bg-wishka-600">Tambah Kategori Partner</a>
                <br><br>
                <livewire:table.master name="PartnerCategory"/>
            </div>
        </div>
    </div>
</x-admin-layout>
