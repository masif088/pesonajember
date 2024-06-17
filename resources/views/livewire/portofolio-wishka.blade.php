<div>
    <nav
        class="flex overflow-x-auto  content-center items-center justify-center rounded-xl mb-5"
        aria-label="Tabs">
        @foreach($categories as $index=>$tab)
            <button class="pl-3 pr-3 pt-5 pb-4 group transition duration-300">
                <div class="px-5 py-2 min-w-[100px] btn text-xl {{ $tab['key']==$active? 'text-white bg-wishka-400':'bg-white text-wishka-400' }}" style="border-radius: 10px" wire:click="setActive({{$tab['key']}})">
                    {{ $tab['value'] }}
                </div>
            </button>
        @endforeach
    </nav>

    <div class="flex content-center items-center justify-center gap-2  mt-5" style="margin: 0 100px">
        <div class="grid grid-cols-12 gap-2">
            @foreach($products as $product)
                <img src="{{ $product['photo_product']?asset('storage/'.str_replace('public','',$product['photo_product'])):asset('storage/mockup/img.png') }}" alt="" class="lg:col-span-3 col-span-6">
            @endforeach
        </div>

    </div>

</div>
