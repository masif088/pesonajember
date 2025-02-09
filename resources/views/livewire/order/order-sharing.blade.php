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
    </table>
    <br>
    <table class="text-md">
        <tr style="height: 40px">
            <td>Input Keterangan Sharing</td>
            <td class="pr-5 pl-5">:</td>
            <td>
                <div class="flex gap-3">
                <span>
                    <input type="text" required
                           class="input bg-gray-200 pc border-1 border border-gray-100 rounded py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white"
                           wire:model.live="title">
                </span>


                </div>


            </td>
            <td>
                <div class="flex gap-3">
                <span class="bg-green-900 p-2  rounded hover:bg-green-200">
                    <span wire:click="addSharing"
                          class="iconify text-white text-2xl "
                          data-icon="mingcute:add-fill"></span>
                    </span>
                </div>
            </td>
        </tr>
        @foreach($sharingTitle as $index=>$st)
            <tr style="height: 40px">
                <td>
                    @if($index==0)
                        Sharing list
                    @endif
                </td>
                <td class="pr-5 pl-5"></td>

                <td> - {{ $st->title }}</td>
                <td class="text-right">
                    <div class="flex justify-end">
                        <div class="bg-red-100 rounded p-1" style="" wire:click="deleteItem({{$st->id}})">
                                        <span class="iconify text-red-900 text-xl"
                                              data-icon="mingcute:delete-fill"></span>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach

    </table>
    <br><br>
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
                    <table class="table p-2 m-1 table-fixed" >
                        <thead>
                        <tr class="font-bold border-b text-center" style="height: 40px">
                            <td style="min-width: 200px">Nama Barang</td>
                            <td style="min-width: 100px">Qty</td>
                            <td style="min-width: 200px">Harga Per Pcs</td>
                            <td style="min-width: 200px">Harga Setelah <br>Pajak Per Pcs</td>
                            @foreach($sharingTitle as $index=>$st)
                                <td style="min-width: 200px">% Share  {{ $st->title }}</td>
                                <td style="min-width: 200px">Share  {{ $st->title }}</td>
                                <td style="min-width: 200px">Jumlah Share  {{ $st->title }}</td>
                            @endforeach
                        </tr>
                        </thead>
                        @php
                            $total = 0;
                            $stotal= [];
                            foreach($sharingTitle as $index=>$st){
                                $stotal[$st->id]=0;
                            }
                        @endphp
                        @foreach($p['items'] as $item)
                            @php
                                $dpp =$item['price']*100/(100+$ppn);
                                $ppnProduct = $item['price'] - $dpp;
                                $pphProduct = $pph*$dpp/100;
                                $afterTax = $dpp -$pphProduct;
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
                                <td>
                                    <div class="p-2 justify-between flex">
                                        <span>Rp. </span>
                                        <span>
                                        {{ thousand_format($afterTax) }}
                                    </span>
                                    </div>
                                </td>
                                @foreach($sharingTitle as $index=>$st)
                                    <td class="text-center">
                                        <input type="number" style="width: 100px"
                                               wire:change="saveSharing({{$st->id}},{{$item['id']}})"
                                               wire:model.live="sharing.{{$st->id}}.{{$item['id']}}"
                                               class="input bg-gray-200 border-1 border border-gray-100 rounded py-2  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white"
                                        >
                                    </td>
                                    <td>
                                        <div class="p-2 justify-between flex">
                                            <span>Rp. </span>
                                            <span>{{ thousand_format($sharing[$st->id][$item['id']]*$afterTax/100) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="p-2 justify-between flex">
                                            @php
                                            $ttl= $sharing[$st->id][$item['id']]*$afterTax/100*$item['quantity'];
                                            $stotal [$st->id]+=$ttl;
                                            @endphp
                                            <span>Rp. </span>
                                            <span>{{ thousand_format($ttl) }}</span>
                                        </div>
                                    </td>
                                @endforeach



                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>


                            @foreach($sharingTitle as $index=>$st)
                                <td></td>
                                <td class="text-end pr-2 font-bold">JUMLAH</td>
                            <td class="py-2 pr-2">
                                <div class="bg-green-100 rounded text-green-900 p-2 justify-between flex">
                                    <span>
                                    Rp.
                                    </span>
                                    <span>
                                        {{ thousand_format($stotal[$st->id]) }}
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
    <br><br>
    <a href="{{ $buttonDisable?'#':route('admin.margin.index',$order->transaction_type_id) }}"
       class="rounded bg-green-900 text-white px-10 py-2 float-right">
        Selesai
    </a>


</div>
