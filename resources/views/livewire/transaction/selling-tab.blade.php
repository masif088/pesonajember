<div class="w-full max-w-[100%] pb-5">
    <br>
    <nav
        class="flex overflow-x-auto bg-wishka-200 dark:bg-dark dark:border content-center items-center justify-center rounded-xl"
        aria-label="Tabs">
        @foreach($sellingTab as $index=>$tab)
            <button class="pl-3 pr-3 pt-5 pb-4 group transition duration-300" wire:click="setActiveTab('{{$tab}}')">
                <div class="pl-2 pr-2 min-w-[100px]">
                    {{ $tab }}
                </div>
                @if($tab==$activeTab)
                    <span
                        class="rounded-2xl block max-w-full transition-all duration-500 h-[3px] mt-0.5 dark:bg-cyan-400 bg-cyan-600"></span>
                @else
                    <span
                        class="rounded-2xl block max-w-0 group-hover:max-w-full transition-all duration-500 h-[3px] mt-1 bg-wishka-400 dark:bg-cyan-500"></span>
                @endif
            </button>
        @endforeach
    </nav>
    <br>
    <div class="rounded-xl border shadow-lg p-5" style="min-height: 70vh">
        <div class="{{ $activeTab=="Penagihan"?'block':'hidden' }}">
            <a href="{{ route('transaction.create') }}" class="btn bg-wishka-600 mt-5">Buat Transaksi</a>
            <br><br>
            <livewire:table.production name="TransactionNewOrder"/>
        </div>
        <div class="{{ $activeTab=="DP-diterima"?'block':'hidden' }}">
            <livewire:table.production name="TransactionDpAccept"/>
        </div>
        <div class="{{ $activeTab=="Proses-Produksi"?'block':'hidden' }}">
            <livewire:table.production name="TransactionProduction"/>
        </div>
{{--        <div class="{{ $activeTab=="Pelunasan"?'block':'hidden' }}">--}}
{{--            <livewire:table.production name="TransactionRepayment"/>--}}
{{--        </div>--}}
        <div class="{{ $activeTab=="Pengiriman"?'block':'hidden' }}">
            <livewire:table.production name="TransactionDelivery"/>
        </div>
        <div class="{{ $activeTab=="Selesai"?'block':'hidden' }}">
            <livewire:table.production name="TransactionDone"/>
        </div>
        <div class="{{ $activeTab=="Cancel"?'block':'hidden' }}">
            <livewire:table.production name="TransactionCancel"/>
        </div>
    </div>
</div>
