<div>
    <div class="flex gap-3 overflow-auto" style="height: 30vh; flex-direction: column">
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
                    <table class="table w-full">
                        <tr class="font-bold border-b" style="height: 40px">
                            <td>Nama Barang</td>
                            <td>Qty</td>
                            <td>Harga Per Pcs</td>
                            <td>Harga Setelah <br> Pajak Per Pcs</td>
                            <td>HPP Per Produk</td>
                            <td style="width: 200px">Jumlah HPP</td>
                        </tr>
                        @foreach($p['items'] as $item)
                            @php

                                $dpp =$item['price']*100/(100+$ppn);
                                $ppnProduct = $item['price'] - $dpp;
                                $pphProduct = $pph*$dpp/100;
                                $afterTax = $dpp -$pphProduct;
                            @endphp
                            <tr style="height: 60px">
                                <td>{{ $item['name'] }}</td>
                                <td>{{ thousand_format($item['quantity']) }}pcs</td>
                                <td>Rp. {{ thousand_format($item['price']) }}</td>
                                <td>Rp. {{ thousand_format($afterTax) }}</td>
                                <td>
                                    <input type="number"
                                           class="input bg-gray-200 pc border-1 border border-gray-100 rounded py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white"
                                           wire:model.live="hpp.{{$item['id']}}">
                                </td>
                                <td>
                                    @if(is_numeric($hpp[$item['id']]))
                                        Rp. {{ thousand_format($item['quantity']*$hpp[$item['id']]) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td></td>


                            <td></td>
                            <td></td>
                            <td></td>
                            <td>JUMLAH</td>

                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>
                                    Rp.
                                    </span>
                                    <span>
                                        {{ thousand_format(0) }}
                                    </span>
                                </div>
                            </td>

                        </tr>

                    </table>
                </div>
            @endif
        @endforeach
    </div>


</div>
