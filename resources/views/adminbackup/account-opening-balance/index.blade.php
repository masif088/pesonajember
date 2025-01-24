<x-admin-layout>
    <x-slot name="title">
        Saldo awal
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('finance.account-opening-balance.create') }}" class="btn bg-wishka-600">Tambah Saldo Awal</a>
                <br><br>
                <livewire:table.master name="AccountOpeningBalance"/>
            </div>
        </div>
    </div>
</x-admin-layout>
