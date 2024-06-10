<div class="card ">

    <div class="card-body ">
        <h5 class="card-title">Target Bulan {{ month_name(\Carbon\Carbon::now()->month) }} - {{ month_name(\Carbon\Carbon::now()->month-1) }}
        </h5>
        <br>
        <p class="card-subtitle font-bold">Bulan {{ month_name(\Carbon\Carbon::now()->month) }}</p>
        <div class="mb-6">
            <div class="flex justify-between items-center mb-3">
                <div>
                    <h6>Target Produksi</h6>
                    <p>{{ thousand_format($production) }}/{{ $productionGoals }}</p>
                </div>
                <div>
                    <span class="badge-md bg-lightprimary dark:bg-darkprimary  text-primary">{{ $production/$productionGoals*100 }}%</span>
                </div>
            </div>
            <!-- Progress -->
            <div class="flex w-full h-1 bg-lightprimary dark:bg-darkprimary rounded-md overflow-hidden" role="progressbar" aria-valuenow="{{ $production/$productionGoals*100 }}" aria-valuemin="0" aria-valuemax="100">
                <div class="flex flex-col justify-center overflow-hidden bg-primary text-xs text-white text-center whitespace-nowrap transition duration-500 " style="width: {{ $production/$productionGoals*100 }}%"></div>
            </div>
            <!-- End Progress -->
        </div>
        <div>
            <div class="flex justify-between items-center mb-3">
                <div>
                    <h6>Target Pendapatan </h6>
                    <p>Rp. {{ thousand_format($revenue) }} / {{ thousand_format($revenueGoals) }}</p>
                </div>
                <div>
                    <span class="badge-md bg-lightsecondary dark:bg-darksecondary  text-secondary">{{ $revenue/$revenueGoals*100 }}%</span>
                </div>
            </div>
            <!-- Progress -->
            <div class="flex w-full h-1 bg-lightsecondary dark:bg-darksecondary rounded-md overflow-hidden" role="progressbar" aria-valuenow="{{ $revenue/$revenueGoals*100 }}" aria-valuemin="0" aria-valuemax="100">
                <div class="flex flex-col justify-center overflow-hidden bg-secondary text-xs text-white text-center whitespace-nowrap transition duration-500 " style="width: {{ $revenue/$revenueGoals*100 }}%"></div>
            </div>
            <!-- End Progress -->
        </div>
        <br>
        <hr>
        <br>
        <p class="card-subtitle font-bold">Bulan {{ month_name(\Carbon\Carbon::now()->month-1) }}</p>
        <div class="mb-6">
            <div class="flex justify-between items-center mb-3">
                <div>
                    <h6>Target Produksi</h6>
                    <p>{{ thousand_format($production2) }}/{{ $productionGoals }}</p>
                </div>
                <div>
                    <span class="badge-md bg-lightprimary dark:bg-darkprimary  text-primary">{{ $production2/$productionGoals*100 }}%</span>
                </div>
            </div>
            <!-- Progress -->
            <div class="flex w-full h-1 bg-lightprimary dark:bg-darkprimary rounded-md overflow-hidden" role="progressbar" aria-valuenow="{{ $production2/$productionGoals*100 }}" aria-valuemin="0" aria-valuemax="100">
                <div class="flex flex-col justify-center overflow-hidden bg-primary text-xs text-white text-center whitespace-nowrap transition duration-500 " style="width: {{ $production2/$productionGoals*100 }}%"></div>
            </div>
            <!-- End Progress -->
        </div>
        <div>
            <div class="flex justify-between items-center mb-3">
                <div>
                    <h6>Target Pendapatan </h6>
                    <p>Rp. {{ thousand_format($revenue2) }} / {{ thousand_format($revenueGoals) }}</p>
                </div>
                <div>
                    <span class="badge-md bg-lightsecondary dark:bg-darksecondary  text-secondary">{{ $revenue2/$revenueGoals*100 }}%</span>
                </div>
            </div>
            <!-- Progress -->
            <div class="flex w-full h-1 bg-lightsecondary dark:bg-darksecondary rounded-md overflow-hidden" role="progressbar" aria-valuenow="{{ $revenue2/$revenueGoals*100 }}" aria-valuemin="0" aria-valuemax="100">
                <div class="flex flex-col justify-center overflow-hidden bg-secondary text-xs text-white text-center whitespace-nowrap transition duration-500 " style="width: {{ $revenue2/$revenueGoals*100 }}%"></div>
            </div>
            <!-- End Progress -->
        </div>


    </div>
</div>
