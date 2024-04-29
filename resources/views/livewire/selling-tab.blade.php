<div class="w-full max-w-[100%] p-5">
    <nav
        class=" -mb-px flex overflow-x-auto bg-wishka-200 content-center items-center justify-center"
        aria-label="Tabs"
    >
        @foreach($sellingTab as $index=>$tab)
        <button class="p-5 group transition duration-300" wire:click="setActiveTab('{{$tab}}')">
            <div class="pl-2 pr-2 min-w-[125px]">
                {{ $tab }}
            </div>
            @if($tab==$activeTab)
                <span class="rounded-2xl block max-w-full transition-all duration-500 h-[3px] mt-1 bg-cyan-600"></span>
            @else
                <span class="rounded-2xl block max-w-0 group-hover:max-w-full transition-all duration-500 h-[3px] mt-1 bg-wishka-700"></span>
            @endif
        </button>
        @endforeach
    </nav>

    <div>
        <div class="{{ $activeTab=="Penagihan"?'block':'hidden' }}">
            <livewire:selling-tab.penagihan/>
        </div>
        <div class="{{ $activeTab=="DP diterima"?'block':'hidden' }}">
            <livewire:selling-tab.dp-diterima/>
        </div>
        <div class="{{ $activeTab=="Proses Produksi"?'block':'hidden' }}">
            <livewire:selling-tab.penagihan/>
        </div>
        <div class="{{ $activeTab=="Pelunasan"?'block':'hidden' }}">
            <livewire:selling-tab.penagihan/>
        </div>
        <div class="{{ $activeTab=="Pengiriman"?'block':'hidden' }}">
            <livewire:selling-tab.penagihan/>
        </div>
        <div class="{{ $activeTab=="Selesai"?'block':'hidden' }}">
            <livewire:selling-tab.penagihan/>
        </div>
        <div class="{{ $activeTab=="Cancel"?'block':'hidden' }}">
            <livewire:selling-tab.penagihan/>
        </div>



    </div>



</div>
