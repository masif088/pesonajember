<x-admin-layout>
    <x-slot name="title">
        Bank
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('bank.create') }}" class="btn bg-wishka-600">Tambah Bank</a>
                <br><br>
                <livewire:table.master name="Bank"/>
            </div>
        </div>
    </div>
</x-admin-layout>
