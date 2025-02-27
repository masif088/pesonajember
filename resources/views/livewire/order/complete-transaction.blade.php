<div>
    <table class="text-lg">
        <tr>
            <td>Nama Konsumen</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->name }}</td>
        </tr>
        <tr>
            <td>Nama Perusahaan</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->company_name }}</td>
        </tr>

        <tr>
            <td>Total contract</td>
            <td class="pr-5 pl-5">:</td>
            <td>Rp. {{ thousand_format($order->orderProducts->sum('value')) }}</td>
        </tr>


    </table>
    <br>
    <hr>
    <br>

    <livewire:order.order-preview-details :order-id="$orderId" sharing="1"/>

    <table class="text-xl font-bold mt-10">
        @if($order->transaction_type_id ==3)
            <tr>
                <td>Total contract</td>
                <td class="pr-5 pl-5">:</td>
                <td>Rp. {{ thousand_format($order->orderProducts->sum('value')) }}</td>
            </tr>
            <tr>
                <td>Nilai asli atau nilai cair</td>
                <td class="pr-5 pl-5">:</td>
                <td>Rp. {{ thousand_format($order->value) }}</td>
            </tr>
            <tr>
                <td>Persentase pendapatan</td>
                <td class="pr-5 pl-5">:</td>
                <td>{{ $order->percentage }}%</td>
            </tr>
            <tr>
                <td>Total pendapatan</td>
                <td class="pr-5 pl-5">:</td>
                <td>Rp. {{ thousand_format($order->percentage*$order->value/100) }}</td>
            </tr>
        @else
            <tr>
                <td>Total contract</td>
                <td class="pr-5 pl-5">:</td>
                <td>Rp. {{ thousand_format($order->orderProducts->sum('value')) }}</td>
            </tr>

            <tr>
                <td>Total profit</td>
                <td class="pr-5 pl-5">:</td>
                <td>Rp. {{ thousand_format($getAll) }}</td>
            </tr>

        @endif

    </table>
    <br><br>
    <button wire:click="endTransaction" class="px-6 py-2 rounded flex-nowrap text-nowrap bg-green-900 hover:bg-green-200 text-white text-lg float-right">
        Selesaikan transaksi
    </button>
</div>
