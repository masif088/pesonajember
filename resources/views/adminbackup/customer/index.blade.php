@php use App\Models\Customer; @endphp
<x-admin-layout>

    <x-slot name="title">
        Rekap Konsumen
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">

                <div
                    class="gap-5 lg:grid lg:grid-cols-12 bg-wishka-200 rounded-2xl p-5 divide-x-2 shadow-lg items-center justify-center">

                    <div class="col-span-6 text-left text-lg pl-5 ">
                        <b>{{ Customer::get()->count() }}</b> <br>
                        Total Konsumen
                    </div>
                    <div class="col-span-6 text-left text-lg pl-5 ">
                        <b>{{ Customer::has('transactions','>',2)->get()->count() }}</b> <br>
                        Total Repeat Order
                    </div>

                </div>
                <br><br>
                <a href="{{ route('customer.create') }}" class="btn bg-wishka-600">Tambah Customer</a>
                <br><br>

                <livewire:table.master name="Customer"/>

            </div>
        </div>
    </div>
</x-admin-layout>
