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
            <td>Nomer Telepon</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->phone }}</td>
        </tr>
    </table>
    <br>
    <hr>
    <br>

    <div class="flex gap-3" style=" flex-direction: column">
        @foreach($partners as $key=>$p)
            <div class="col-span-12 mb-2" style="height: 20px">
                <div class="flex">
                    <span class="font-bold text-md" style="margin-right: 20px">{{ $p['title'] }} [{{ count($p['items']) }}]</span>
                    @if($p['status'])
                        <span wire:click="openAndClose({{$key}})"
                              class="iconify text-gray-600 text-2xl bg-green-200 rounded"
                              data-icon="iconamoon:arrow-up-2-bold"></span>
                    @else
                        <span wire:click="openAndClose({{$key}})"
                              class="iconify text-gray-600 text-2xl bg-green-200 rounded"
                              data-icon="iconamoon:arrow-down-2-bold"></span>
                    @endif
                </div>
            </div>
            @if($p['status'])
                <div class="col-span-12 mb-2">
                    <table class="table w-full overflow-x-auto">
                        <tr class="font-bold border-b" style="height: 40px">
                            <td>Nama Barang</td>
                            <td>Qty</td>
                            <td class="text-center">Harga Barang</td>
                            <td class="text-center">Nilai Kontrak</td>
                            <td class="text-center">DPP/TNP PPN</td>
                            <td class="text-center">PPN({{$ppn}}%)</td>
                            <td class="text-center">PPH({{$pph}}%)</td>
                            <td class="text-center">Harga <br> Setelah Pajak</td>
                            <td class="text-center">Total Harga <br>Setelah Pajak</td>
                        </tr>
                        @php
                            $dppCount =0;
                                    $ppnProductCount = 0;
                                    $pphProductCount = 0;
                                    $afterTaxCount = 0;
                                    $valueCount= 0;
                                    $valueAfterTaxCount= 0;
                        @endphp

                        @foreach($p['items'] as $item)
                            @php
                                $valueCount+=$item['price'];
                                    $dpp =$item['price']*100/(100+$ppn);
                                    $dppCount+=$dpp;
                                    $ppnProduct = $item['price'] - $dpp;
                                    $ppnProductCount+=$ppnProduct;
                                    $pphProduct = $pph*$dpp/100;
                                    $pphProductCount+=$pphProduct;
                                    $afterTax = $dpp -$pphProduct;
                                    $afterTaxCount+=$afterTax;
                                    $valueAfterTaxCount+=$afterTax*$item['quantity'];
                            @endphp
                            <tr style="height: 40px">
                                <td>{{ $item['name'] }}</td>
                                <td>{{ thousand_format($item['quantity']) }}pcs</td>
                                <td><div class="flex justify-between py-2 px-4">
<span>Rp.</span> <span>{{ thousand_format($item['price']) }}</span>
                                    </div></td>
                                <td><div class="flex justify-between py-2 px-4">
<span>Rp.</span> <span>{{ thousand_format($item['value']) }}</span>
                                    </div></td>
                                <td><div class="flex justify-between py-2 px-4">
<span>Rp.</span> <span>{{ thousand_format($dpp) }}</span>
                                    </div></td>
                                <td><div class="flex justify-between py-2 px-4">
<span>Rp.</span> <span>{{ thousand_format($ppnProduct) }}</span>
                                    </div></td>
                                <td><div class="flex justify-between py-2 px-4">
<span>Rp.</span> <span>{{ thousand_format($pphProduct) }}</span>
                                    </div></td>
                                <td><div class="flex justify-between py-2 px-4">
<span>Rp.</span> <span>{{ thousand_format($afterTax) }}</span>
                                    </div></td>
                                <td><div class="flex justify-between py-2 px-4">
<span>Rp.</span> <span>{{ thousand_format($afterTax*$item['quantity']) }}</span>
                                    </div></td>
                            </tr>
                        @endforeach
                        <tr class="border-t font-bold">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>
                                    Rp.
                                    </span>
                                    <span>
                                        {{ thousand_format($valueCount) }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>Rp. </span>
                                    <span>{{ thousand_format($dppCount) }}</span>
                                </div>
                            </td>
                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>Rp. </span>
                                    <span>
                                        {{ thousand_format($ppnProductCount) }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>Rp. </span>
                                    <span>
                                        {{ thousand_format($pphProductCount) }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>Rp. </span>
                                    <span>
                                        {{ thousand_format($afterTaxCount) }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>Rp. </span>
                                    <span>
                                        {{ thousand_format($valueAfterTaxCount) }}
                                    </span>
                                </div>
                            </td>

                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
    </div>

    <div class="flex" style="justify-content:space-between">
        <a href="" class="text-green-900 bg-green-100 rounded px-4 py-2">Lakukan Perubahan</a>
        <a href="" class="text-white bg-green-900 rounded px-4 py-2">Konfirmasi Transaksi</a>

    </div>


</div>
