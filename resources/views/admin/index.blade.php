<x-admin-layout>

    <x-slot name="title">
        Dashboard
    </x-slot>
    <div class="" >

        <div class="grid grid-cols-12 gap-3" style="padding-bottom: 50px">


            <br>
            <div class="col-span-12 mb-2">
            <livewire:attendance.dashboard-attendance />
            </div>




{{--            <br>--}}
            @if(auth()->user()->hasPermissionTo('dashboard-penjualan', 'sanctum'))
                <div class="col-span-12 ">
                    <livewire:dashboard.dashboard-card/>
                </div>
                <div class="lg:col-span-6 col-span-12">
                    <livewire:dashboard.dashboard-attendance/>
                </div>

                <div class="lg:col-span-6 col-span-12">
                    <livewire:dashboard.dashboard-goals/>
                </div>

                <div class="lg:col-span-6 col-span-12">
                    <livewire:dashboard.dashboard-revenue/>
                </div>
            @elseif(auth()->user()->hasPermissionTo('dashboard-produksi', 'sanctum'))
                <div class="col-span-12 ">
                    <livewire:dashboard.dashboard-card/>
                </div>
                <div class="lg:col-span-12 col-span-12">
                    <livewire:dashboard.dashboard-attendance/>
                </div>

                <div class="lg:col-span-6 col-span-12">
                    <livewire:dashboard.dashboard-goals/>

                </div>
                <div class="col-span-12">
                    <livewire:production.person-in-charge/>
                </div>
            @else
                <div class="lg:col-span-12 col-span-12">
                    <livewire:dashboard.dashboard-attendance/>

                </div>

            @endif


{{--            <div class="col-span-4">--}}
{{--                <livewire:dasbhboard.dashboard-product/>--}}
{{--            </div>--}}
        </div>
    </div>
</x-admin-layout>
