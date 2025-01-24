<x-admin-layout>
    <x-slot name="title">
        Koperasi
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br>
                <div class="text-lg text-black">
                    Nama : {{ \App\Models\User::find($user)->name }}<br>
                    Hutang Saat ini : Rp. {{ thousand_format(abs(\App\Models\CooperativeCreditEmployee::where('user_id',$user)->first()->credit)) }}
                </div>
                <br>
                <livewire:table.master name="CreditEmployeePay" :param1="$user"/>
            </div>
        </div>
    </div>
</x-admin-layout>
