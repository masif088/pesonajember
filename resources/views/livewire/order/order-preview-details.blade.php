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
                            @if($type!=3)
                                <td style="min-width: 60px" class="text-center">%PPH</td>
                            @endif
                            <td style="min-width: 150px" class="text-center">Harga Barang</td>
                            <td style="min-width: 150px" class="text-center">Nilai Kontrak</td>
                            @if($type!=3)
                                <td style="min-width: 150px" class="text-center">DPP/TNP PPN</td>
                                <td style="min-width: 150px" class="text-center">PPN({{$ppn}}%)</td>
                                <td style="min-width: 150px" class="text-center">PPH</td>

                                <td style="min-width: 150px" class="text-center">Harga <br> Setelah Pajak</td>
                                <td style="min-width: 150px" class="text-center">Total Harga <br>Setelah Pajak</td>
                            @endif
                            @if($sharing)
                                <td style="min-width: 150px" class="text-center">Total HPP</td>

                                @foreach($sharingTitle as $index=>$st)
                                    <td style="min-width: 100px">% Share <br> {{ $st->title }}</td>
                                    <td style="min-width: 200px">Jumlah Share <br> {{ $st->title }}</td>
                                @endforeach
                                <td style="min-width: 200px">
                                    Keuntungan bersih
                                </td>
                            @endif

                        </tr>
                        @php
                            $dppCount =0;
                            $ppnProductCount = 0;
                            $pphProductCount = 0;
                            $afterTaxCount = 0;
                            $valueCount= 0;
                            $valueAfterTaxCount= 0;
                            $margin =0;
                            $totalHpp =0;


                                $total = 0;
                                $stotal= [];
                                foreach($sharingTitle as $index=>$st){
                                    $stotal[$st->id]=0;
                                }

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
                                $totalHpp += $item['hpp_value'];

                                $afterTaxCount+=$afterTax;
                                $valueAfterTaxCount+=$afterTax*$item['quantity'];
    if($type!=3){
        $values = [$item['price'],$item['value'],$dpp,$ppnProduct,$pphProduct,$afterTax,($afterTax*$item['quantity'])];
    }else{
        $values = [$item['price'],$item['value'],];
    }

                            @endphp
                            <tr style="height: 40px">
                                <td>{{ $item['name'] }}</td>
                                <td>{{ thousand_format($item['quantity']) }}pcs</td>
                                @if($type!=3)
                                    <td class="text-center">{{ $item['pph'] }}%</td>
                                @endif
                                @foreach($values as $value)
                                    <td>
                                        <div class="flex justify-between py-2 px-4">
                                            <span>Rp.</span> <span>{{ thousand_format($value) }}</span>
                                        </div>
                                    </td>
                                @endforeach
                                @if($sharing)
                                    <td>
                                        <div class="flex justify-between py-2 px-4">
                                            <span>Rp.</span> <span>{{ thousand_format($item['hpp_value']) }}</span>
                                        </div>
                                    </td>
                                    @php
                                        $totalSharingProduct = 0;
                                    @endphp
                                    @foreach($sharingTitle as $index=>$st)
                                        <td class="text-center">
                                            {{ $sharings[$st->id][$item['id']] }}%
                                        </td>
                                        <td>
                                            <div class="p-2 justify-between flex">
                                                @php
                                                    $ttl= $sharings[$st->id][$item['id']]*$afterTax/100*$item['quantity'];
                                                    $stotal [$st->id]+=$ttl;
                                                    $totalSharingProduct+=$ttl;
                                                @endphp
                                                <span>Rp. </span>
                                                <span>{{ thousand_format($ttl) }}</span>
                                            </div>
                                        </td>
                                    @endforeach
                                    <td>
                                        @php
                                            $margin+= ($afterTax*$item['quantity'])-$totalSharingProduct-$item['hpp_value'];
                                        @endphp
                                        <div class="p-2 justify-between flex">
                                            <span>Rp. </span>
                                            <span>{{ thousand_format(($afterTax*$item['quantity'])-$totalSharingProduct-$item['hpp_value']) }}</span>
                                        </div>

                                    </td>
                                @endif
                            </tr>
                        @endforeach

                        @php
                            if ($type!=3){
                                 $values = [$valueCount,$dppCount,$ppnProductCount,$pphProductCount,$afterTaxCount,$valueAfterTaxCount];
                            }else{
                                 $values = [$valueCount];
                            }

                        @endphp
                        <tr class="border-t font-bold">
                            @if($type!=3)
                                <td></td>
                            @endif
                            <td></td>
                            <td></td>
                            <td class="py-2 pr-2">
                                <div class="bg-gray-200 rounded p-2 text-center">
                                    Jumlah Nilai
                                </div>
                            </td>

                            @foreach($values as $value)
                                <td class="py-2 pr-2">
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
                            @if($sharing)
                                <td>
                                    <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                        <span>Rp.</span> <span>{{ thousand_format($totalHpp) }}</span>
                                    </div>
                                </td>



                                @foreach($sharingTitle as $index=>$st)
                                    <td></td>
                                    <td>
                                        <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                            <span>Rp.</span> <span>{{ thousand_format($stotal[$st->id]) }}</span>
                                        </div>
                                    </td>
                                @endforeach
                                <td>
                                    <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                        <span>Rp.</span> <span>{{ thousand_format($margin) }}</span>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    </table>
                </div>
            @endif

        @endforeach


    </div>
</div>
