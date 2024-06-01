<div class="w-full max-w-[100%] pb-5">
    <br>
    <nav class="flex overflow-x-auto bg-wishka-200 dark:bg-dark dark:border content-center items-center justify-center rounded-xl"
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
    <div class="rounded-xl border shadow-lg p-5" style="height: 70vh">
        <div class="{{ $activeTab=="Potong"?'block':'hidden' }}">
            <livewire:table.production name="ProductionCut"/>
        </div>
        <div class="{{ $activeTab=="Print"?'block':'hidden' }}">
            <livewire:table.production name="ProductionPrint"/>
        </div>
        <div class="{{ $activeTab=="Pasang-Label"?'block':'hidden' }}">
            <livewire:table.production name="ProductionLabel"/>
        </div>
        <div class="{{ $activeTab=="Jahit"?'block':'hidden' }}">
            <livewire:table.production name="ProductionSew"/>
        </div>
        <div class="{{ $activeTab=="Quality-Control"?'block':'hidden' }}">
            <livewire:table.production name="ProductionQc"/>
        </div>
        <div class="{{ $activeTab=="Packing"?'block':'hidden' }}">
            <livewire:table.production name="ProductionPacking"/>
        </div>
{{--        <div class="{{ $activeTab=="Selesai"?'block':'hidden' }}">--}}
{{--            <livewire:table.production name="ProductionDone"/>--}}
{{--        </div>--}}
    </div>
</div>
