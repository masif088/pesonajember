<div class="card col-span-12 shadow-none border">
    <div class="card-body">

        <span>
            <div class="card-title">
                Detail Transaksi
                        @if($open)
                    <span wire:click="openAndClose()"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded float-right"
                          data-icon="iconamoon:arrow-up-2-bold"></span>
                @else
                    <span wire:click="openAndClose()"
                          class="iconify text-gray-600 text-2xl bg-green-200 rounded  float-right"
                          data-icon="iconamoon:arrow-down-2-bold"></span>
                @endif
            </div>

        </span>

        @if($open)
            <br>
            <livewire:order.order-preview-details :order-id="$orderId"/>
        @endif

    </div>
</div>
