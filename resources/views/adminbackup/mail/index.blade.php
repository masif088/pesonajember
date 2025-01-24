<x-admin-layout>
    <x-slot name="title">
        Email terkirim
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>
                <a href="{{ route('mail.create') }}" class="btn bg-wishka-600">Buat email custom</a>
                <br><br>
                <livewire:table.master name="MailHistory"/>
            </div>
        </div>
    </div>
</x-admin-layout>
