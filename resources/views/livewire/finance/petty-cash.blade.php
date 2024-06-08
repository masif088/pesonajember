<div class="col-span-12 text-center">
    <h1 class="text-2xl uppercase text-center">
        Catatan Kas Kecil {{ $monthName[intval($month)-1] }} {{ $year }}
    </h1>

    <br>
    <div class="grid w-full grid-cols-12 bg-wishka-200 rounded-2xl p-2">
        <div class="col-span-2 text-start">
            <i class="ti ti-chevron-left text-2xl p-2" wire:click="decrementMonth"></i>
        </div>
        <div class="col-span-8 text-center align-middle" style="display: table">
            <div class="table-cell align-middle text-lg"><b>Bulan {{ $monthName[$month-1] }} {{ $year }}</b></div>
        </div>
        <div class="col-span-2 text-end">
            <i class="ti ti-chevron-right text-2xl p-2" wire:click="incrementMonth"></i>
        </div>
    </div>
    <br><br>
    <livewire:table.master name="BigCash" :param1="$month" :param2="$year"/>
</div>
