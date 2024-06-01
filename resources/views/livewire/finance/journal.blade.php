<div class="col-span-12">
    <br><br>
    <a href="{{ route('finance.journal.create') }}" class="btn bg-wishka-600">Tambah Jurnal</a>
    <br><br>
    <div class="grid w-full grid-cols-12 bg-wishka-200 rounded-2xl p-2">
        <div class="col-span-2">
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
    <livewire:table.master name="Journal" sort-field="journal_date" :sort-asc="true" :param1="$month" :param2="$year"/>
</div>
