<x-admin-layout>
    <x-slot name="title">
        Kas besar
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('finance.big-cash.create') }}" class="btn bg-wishka-600">Tambah Kas Besar</a>
                <br><br>

                <livewire:finance.big-cash/>
            </div>
        </div>
    </div>
</x-admin-layout>
