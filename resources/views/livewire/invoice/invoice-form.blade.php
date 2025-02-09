<div class="grid grid-cols-12 gap-3">
    <div class="col-span-12">
        <table>
            <tr style="height: 40px">
                <td>Nama Konsumen</td>
                <td style="width: 100px"></td>
                <td>{{ $order->customer->name }}</td>
            </tr>
            <tr style="height: 40px">
                <td>Nama Perusahaan</td>
                <td style="width: 100px"></td>
                <td>{{ $order->customer->company_name }}</td>
            </tr>
            <tr style="height: 40px">
                <td>No Telepon</td>
                <td style="width: 100px"></td>
                <td>{{ $order->customer->phone }}</td>
            </tr>
            <tr style="height: 40px">
                <td>No Transaction</td>
                <td style="width: 100px"></td>
                <td>{{ $order->order_number }}</td>
            </tr>
        </table>
        <br><br>
    </div>
    <div class="col-span-12">
        <form wire:submit="{{ $action }}">
        <table class="table w-full">
            <thead class="border-b-2 font-bold">
            <tr>
                <td style="width: 170px">Satuan</td>
                <td style="width: 300px">Nama Barang</td>
                <td class="text-center">Harga</td>
                <td class="text-center">Total</td>
            </tr>
            </thead>
            <tbody>
            @php $total=0; @endphp
            @foreach($order->orderProducts as $op)
                @php
                    $total+=($op->price*$op->quantity);
                @endphp
                <tr class="border-b" style="height: 50px">
                    <td>{{ thousand_format($op->quantity) }}pcs</td>
                    <td>{{ $op->name }}</td>
                    <td style="padding: 5px 20px">
                        <div class="flex justify-between">
                            <span>Rp. </span>
                            <span>{{ thousand_format($op->price) }}</span>
                        </div>
                    </td>
                    <td style="padding: 5px 20px">
                        <div class="flex justify-between font-bold">
                            <span>Rp. </span>
                            <span>{{ thousand_format($op->price*$op->quantity) }}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr class="border-b" style="height: 50px">
                <td></td>
                <td></td>
                <td style="padding: 5px 20px">Total</td>
                <td style="padding: 5px 20px">
                    <div class="flex justify-between font-bold">
                        <span>Rp. </span>
                        <span>{{ thousand_format($total) }}</span>
                    </div>
                </td>
            </tr>
            <tr class="border-b" style="height: 50px ">
                <td></td>
                <td></td>
                <td style="padding: 5px 20px">Ongkos Kirim</td>
                <td style="padding: 5px 20px" class="flex justify-between  align-middle">
                    <span style="padding: 10px 0">
                    Rp.
                    </span>
                    <span style="width: 90%">
                        <input type="number" class="form-control text-end" wire:model.live="shippingCost">
                    </span>
                </td>
            </tr>
            <tr class="border-b" style="height: 50px ">
                <td></td>
                <td></td>
                <td style="padding: 5px 20px">Pajak</td>
                <td style="padding: 5px 20px" class="flex justify-between  align-middle">

                    <span style="width: 90%">
                        <input type="number" class="form-control text-end" wire:model.live="tax">
                    </span>
                    <span style="padding: 10px 0">
                    %
                    </span>
                </td>
            </tr>

            <tr class="border-b" style="height: 50px ">
                <td></td>
                <td></td>
                <td style="padding: 5px 20px">Grand Total</td>
                <td style="padding: 5px 20px">
                    <div class="flex justify-between font-bold">
                        <span>Rp. </span>
                        <span>
                            @if( is_numeric($shippingCost) )
                                {{ thousand_format($total+$shippingCost) }}
                            @else
                                {{ thousand_format($total) }}
                            @endif

                        </span>
                    </div>
                </td>
            </tr>

            <tr class="border-b" style="height: 50px ">
                <td></td>
                <td></td>
                <td style="padding: 5px 20px">DP</td>
                <td style="padding: 5px 20px" class="flex justify-between  align-middle">
                     <span style="padding: 10px 0">
                    Rp.
                    </span>
                    <span style="width: 90%">
                        <input type="number" class="form-control text-end" wire:model.live="dp">
                    </span>

                </td>
            </tr>
            <tr class="border-b" style="height: 50px ">
                <td></td>
                <td></td>
                <td style="padding: 5px 20px">Sisa</td>
                <td style="padding: 5px 20px">
                    <div class="flex justify-between font-bold">
                        <span>Rp. </span>
                        <span>
                                @if(is_numeric($dp) and is_numeric($shippingCost))
                                {{ thousand_format($total+$shippingCost-$dp) }}
                            @else
                                {{ thousand_format($total) }}
                            @endif

                        </span>
                    </div>

                </td>
            </tr>
            </tbody>
        </table>
            <x-button-submit class="col-span-3 float-right mt-4" title="Cetak Invoice"/>
        </form>
    </div>
</div>
