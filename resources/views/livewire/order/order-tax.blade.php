<div>
    <table class="text-md">
        <tr style="height: 40px">
            <td>Nama Konsumen</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->name }}</td>
        </tr>
        <tr style="height: 40px">
            <td>Nama Perusahaan</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->company_name }}</td>
        </tr>
        <tr style="height: 40px">
            <td>Nomer Telepon</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->phone }}</td>
        </tr>
        <tr style="height: 40px">
            <td>PPN Order</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->ppn }}%</td>
        </tr>
    </table>
    <br>
    <div class="flex gap-3 overflow-auto" style="; flex-direction: column">
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
                    <table class="table p-2 m-1 table-fixed w-full">
                        <thead>
                        <tr class="font-bold border-b text-center" style="height: 40px">
                            <td style="min-width: 200px">Nama Barang</td>
                            <td style="min-width: 100px">Qty</td>
                            <td style="min-width: 200px">Harga Per Pcs</td>
                            <td style="min-width: 200px">PPN</td>
                            <td style="min-width: 200px">DPP</td>
                            <td style="min-width: 200px">PPH</td>
                            <td style="min-width: 200px">Harga Setelah <br>Pajak Per Pcs</td>
                            <td style="min-width: 200px">Total Setelah <br>Pajak Per Pcs</td>
                        </tr>
                        </thead>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($p['items'] as $item)
                            @php
                                $dpp =$item['price']*100/(100+$ppn);
                                $ppnProduct = $item['price'] - $dpp;
                                $pphProduct = $item['pph']*$dpp/100;
                                $afterTax = $dpp -$pphProduct;
                                $total+= $item['quantity'] * $afterTax;
                            @endphp
                            <tr style="height: 60px">
                                <td>{{ $item['name'] }}</td>
                                <td class="text-center">{{ thousand_format($item['quantity']) }}pcs</td>
                                <td>
                                    <div class="p-2 justify-between flex">
                                        <span>Rp. </span>
                                        <span>
                                        {{ thousand_format($item['price']) }}
                                    </span>
                                    </div>
                                </td>
                                <td class="text-center">{{ $ppn }}%</td>
                                <td>
                                    <div class="p-2 justify-between flex">
                                        <span>Rp. </span>
                                        <span>
                                        {{ thousand_format($dpp) }}
                                    </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <input type="number" style="width: 100px"
                                           wire:change="saveSharing({{$item['id']}})"
                                           wire:model.live="taxPph.{{$item['id']}}"
                                           class="input bg-gray-200 border-1 border border-gray-100 rounded py-2  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white">
                                </td>
                                <td>
                                    <div class="p-2 justify-between flex">
                                        <span>Rp. </span>
                                        <span>
                                        {{ thousand_format($afterTax) }}
                                    </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2 justify-between flex">
                                        <span>Rp. </span>
                                        <span>
                                        {{ thousand_format($afterTax*$item['quantity']) }}
                                    </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-end pr-2 font-bold">Total Keseluruhan</td>
                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>
                                    Rp.
                                    </span>
                                    <span>
                                        {{ thousand_format($total) }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
    </div>
    <br><br>
    <a href="{{ $buttonDisable?'#':route('admin.margin.index',$order->transaction_type_id) }}"
       class="rounded bg-green-900 text-white px-10 py-2 float-right">
        Selesai
    </a>
</div>
