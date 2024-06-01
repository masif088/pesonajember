<x-admin-layout>
    <x-slot name="title">
        Asset perusahaan
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('company-asset.create') }}" class="btn bg-wishka-600">Tambah Asset</a>
                <br><br>
                <livewire:table.company-asset name="CompanyAsset"/>
            </div>
        </div>
    </div>
</x-admin-layout>
