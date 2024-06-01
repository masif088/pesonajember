<x-admin-layout>
    <x-slot name="title">
        Mutasi status
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('mutation-status.create') }}" class="btn bg-wishka-600">Tambah Mutasi status</a>
                <br><br>
                <livewire:table.master name="MutationStatus"/>
            </div>
        </div>
    </div>
</x-admin-layout>
