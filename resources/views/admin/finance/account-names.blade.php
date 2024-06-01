<x-admin-layout>
    <x-slot name="title">
        Nama Account
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('finance.account-names.create') }}" class="btn bg-wishka-600">Tambah Account</a>
                <br><br>
                <livewire:table.master name="Account" sort-field="code" :sort-asc="true"/>
            </div>
        </div>
    </div>
</x-admin-layout>
