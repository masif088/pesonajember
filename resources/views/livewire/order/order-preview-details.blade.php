<div>

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
            <div class="col-span-12 mb-2 overflow-x-auto">
                <table class="table w-full overflow-x-auto">
                    <tr class="font-bold border-b" style="height: 40px">
                        <td style="min-width: 150px">Nama Barang</td>
                        <td style="min-width: 60px">Qty</td>
                        <td style="min-width: 60px" class="text-center">%PPH</td>
                        <td style="min-width: 150px" class="text-center">Harga Barang</td>
                        <td style="min-width: 150px" class="text-center">Nilai Kontrak</td>
                        <td style="min-width: 150px" class="text-center">DPP/TNP PPN</td>
                        <td style="min-width: 150px" class="text-center">PPN({{$ppn}}%)</td>
                        <td style="min-width: 150px" class="text-center">PPH</td>
                        <td style="min-width: 150px" class="text-center">Harga <br> Setelah Pajak</td>
                        <td style="min-width: 150px" class="text-center">Total Harga <br>Setelah Pajak</td>
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

                            $valueCount+=$item['price']*$item['quantity'];
                                $dpp =$item['price']*100/(100+$ppn);
                                $dppCount+=$dpp;
                                $ppnProduct = $item['price'] - $dpp;
                                $ppnProductCount+=$ppnProduct;
                                $pphProduct = $item['pph']*$dpp/100;
                                $pphProductCount+=$pphProduct;
                                $afterTax = $dpp -$pphProduct;


                                $afterTaxCount+=$afterTax;
                                $valueAfterTaxCount+=$afterTax*$item['quantity'];

                                $values = [$item['price'],$item['value'],$dpp,$ppnProduct,$pphProduct,$afterTax,($afterTax*$item['quantity'])]
                        @endphp
                        <tr style="height: 40px">
                            <td>{{ $item['name'] }}</td>
                            <td>{{ thousand_format($item['quantity']) }}pcs</td>
                            <td class="text-center">{{ $item['pph'] }}%</td>
                            @foreach($values as $value)
                                <td>
                                    <div class="flex justify-between py-2 px-4">
                                        <span>Rp.</span> <span>{{ thousand_format($value) }}</span>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    @php
                        $values = [$valueCount,$dppCount,$ppnProductCount,$pphProductCount,$afterTaxCount,$valueAfterTaxCount]
                    @endphp
                    <tr class="border-t font-bold">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="py-2 pr-2">
                            <div class="bg-gray-200 rounded p-2 text-center">
                                Jumlah Nilai
                            </div>
                        </td>
                        @foreach($values as $value)
                            <td class="py-2 pr-2" >
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>
                                    Rp.
                                    </span>
                                    <span>
                                        {{ thousand_format($value) }}
                                    </span>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                </table>
            </div>
            @endif

        @endforeach


    </div>
</div>
