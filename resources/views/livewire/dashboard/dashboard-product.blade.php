<div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
    <div class="card">
        <div class="card-body pb-3">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h5 class="card-title">Penjualan Terbanyak</h5>
                    <p class="card-subtitle">Di bulan kemarin</p>
                </div>
            </div>
            @foreach(\App\Models\Product::get() as $p)
            <div class="flex items-center gap-3 py-4 border-b border-border dark:border-darkborder">
                <div class="text-white bg-lightgray dark:bg-darkgray rounded-full h-11 w-11 flex items-center justify-center">
                    <img src="{{ asset('front/bag-1.png') }}" class="opacity-70 h-4 w-4" alt="icon">
                </div>
                <div>
                    <h6 class="leading-4">
                        {{ $p->title }}
                    </h6>
                </div>
                <div class="  text-dark dark:text-white text-end ms-auto">
                    <span class=" text-error">{{ rand(10,100) }}</span>
                </div>
            </div>
                <div class="flex items-center gap-3 py-4 border-b border-border dark:border-darkborder">
                    <div class="text-white bg-lightgray dark:bg-darkgray rounded-full h-11 w-11 flex items-center justify-center">
                        <img src="{{ asset('front/bag-1.png') }}" class="opacity-70 h-4 w-4" alt="icon">
                    </div>
                    <div>
                        <h6 class="leading-4">
                            {{ $p->title }}
                        </h6>
                    </div>
                    <div class="  text-dark dark:text-white text-end ms-auto">
                        <span class=" text-error">{{ rand(10,100) }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 py-4 border-b border-border dark:border-darkborder">
                    <div class="text-white bg-lightgray dark:bg-darkgray rounded-full h-11 w-11 flex items-center justify-center">
                        <img src="{{ asset('front/bag-1.png') }}" class="opacity-70 h-4 w-4" alt="icon">
                    </div>
                    <div>
                        <h6 class="leading-4">
                            {{ $p->title }}
                        </h6>
                    </div>
                    <div class="  text-dark dark:text-white text-end ms-auto">
                        <span class=" text-error">{{ rand(10,100) }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 py-4 border-b border-border dark:border-darkborder">
                    <div class="text-white bg-lightgray dark:bg-darkgray rounded-full h-11 w-11 flex items-center justify-center">
                        <img src="{{ asset('front/bag-1.png') }}" class="opacity-70 h-4 w-4" alt="icon">
                    </div>
                    <div>
                        <h6 class="leading-4">
                            {{ $p->title }}
                        </h6>
                    </div>
                    <div class="  text-dark dark:text-white text-end ms-auto">
                        <span class=" text-error">{{ rand(10,100) }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 py-4 border-b border-border dark:border-darkborder">
                    <div class="text-white bg-lightgray dark:bg-darkgray rounded-full h-11 w-11 flex items-center justify-center">
                        <img src="{{ asset('front/bag-1.png') }}" class="opacity-70 h-4 w-4" alt="icon">
                    </div>
                    <div>
                        <h6 class="leading-4">
                            {{ $p->title }}
                        </h6>
                    </div>
                    <div class="  text-dark dark:text-white text-end ms-auto">
                        <span class=" text-error">{{ rand(10,100) }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 py-4 border-b border-border dark:border-darkborder">
                    <div class="text-white bg-lightgray dark:bg-darkgray rounded-full h-11 w-11 flex items-center justify-center">
                        <img src="{{ asset('front/bag-1.png') }}" class="opacity-70 h-4 w-4" alt="icon">
                    </div>
                    <div>
                        <h6 class="leading-4">
                            {{ $p->title }}
                        </h6>
                    </div>
                    <div class="  text-dark dark:text-white text-end ms-auto">
                        <span class=" text-error">{{ rand(10,100) }}</span>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
