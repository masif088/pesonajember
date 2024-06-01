<x-admin-layout>
    <x-slot name="title">
        Asset perusahaan - {{ \App\Models\CompanyAsset::find($id)->title }}
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('company-asset.create-shrinkage',$id) }}" class="btn bg-wishka-600">Tambah Penyusutan Manual</a>
                <br><br>
                <livewire:table.company-asset name="CompanyAssetDecreaseValue" :param1="$id"/>
            </div>
        </div>
    </div>
</x-admin-layout>
