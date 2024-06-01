<x-admin-layout>
    <x-slot name="title">
        Jurnal
    </x-slot>
    <div class="">
        <div class="grid grid-cols-12 gap-3">
            <livewire:finance.profit-and-lost/>
        </div>
        <nav class="flex overflow-x-auto content-center items-center justify-center rounded-xl gap-3"
             aria-label="Tabs">
            @php
                $sellingTab=['Jurnal','Buku Besar','Neraca Lajur','Neraca','CALK Neraca','Laba Rugi','CALK Laba Rugi',];
                $link=[route('finance.journal'),
                route('finance.ledger'),
                route('finance.worksheet'),
                route('finance.balance-sheet'),
                route('finance.calc-balance'),
                route('finance.profit-and-loss'),
                route('finance.calc-profit-and-loss'),
                ];
            $activeTab='Laba Rugi';
            @endphp

            @foreach($sellingTab as $index=>$tab)
                <a href="{{ $tab==$activeTab?'#':$link[$index] }}" class="btn @if($tab==$activeTab) bg-wishka-200 @else bg-wishka-600 @endif group transition duration-300">
                    <div class="pl-2 pr-2 min-w-[100px]">
                        {{ $tab }}
                    </div>
                </a>
            @endforeach
        </nav>

    </div>
</x-admin-layout>
