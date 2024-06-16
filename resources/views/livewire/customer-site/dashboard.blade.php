<div class="text-wishka-600 lg:grid grid-cols-12 col-span-12">
    <div class="col-span-12 mb-3">
        <h2 class='text-2xl mb-3'>Selamat Datang,</h2>
        <h2 class='text-2xl'>{{ $customer->name??"User tidak diketahui" }}</h2>
    </div>
    <div class="col-span-12 lg:grid grid-cols-12 gap-3  ">
        @for($i=0;$i<4;$i++)
            <div class="col-span-3">
                <div class="card ">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div class="flex justify-center items-center w-14 h-[50px] bg-lightwarning dark:bg-darkwarning rounded-md">
                                <i class="ti ti-basket text-3xl text-warning"></i>
                            </div>
                            <div class="text-end">
                                <h5 class="card-title">+259</h5>
                                <p class="font-medium">Sales
                                    Change</p>
                            </div>
                        </div>
                        <div class="flex w-full h-1.5 bg-lightwarning dark:bg-darkwarning rounded-md overflow-hidden mt-4" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="flex flex-col justify-center overflow-hidden bg-warning text-xs text-white text-center whitespace-nowrap transition duration-500 " style="width: 25%"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

</div>
