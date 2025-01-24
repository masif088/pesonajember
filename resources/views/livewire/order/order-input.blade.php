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
                            <td>Harga Barang</td>
                            <td>Nilai Kontrak</td>
                            <td></td>
                        </tr>
                        @foreach($p['items'] as $item)
                            <tr style="height: 40px">
                                <td>{{ $item['name'] }}</td>
                                <td>{{ thousand_format($item['quantity']) }}pcs</td>
                                <td>Rp. {{ thousand_format($item['price']) }}</td>
                                <td>Rp. {{ thousand_format($item['value']) }}</td>
                                <td>
                                    <div class="flex">
                                        <div class="bg-red-100 rounded p-1" style="" wire:click="deleteItem({{$item->id}})">
                                        <span class="iconify text-red-900 text-xl"
                                              data-icon="mingcute:delete-fill"></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            @endif
        @endforeach
    </div>
    <br>
    <hr>
    <br>
    <div class="col-span-12 mb-2">
        <h1 class="text-3xl uppercase">Input Order E-Catalog</h1>
    </div>
    <form class="grid grid-cols-12 gap-5 mt-5" wire:submit="addItem">

            <div class="col-span-6">Pilih CV
                <font class="text-green-900">*(Wajib Diisi)</font>

                <select id="partner_id" wire:model.live="formItem.partner_id" name="partner_id" class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
                    <option></option>
                    @foreach($partners as $key=>$p)
                    <option value="{{ $key }}" style="padding: 0 25px">
                        {{ $p['title'] }}
                    </option>
                    @endforeach
                </select>
            </div>



        <div class="col-span-6">Nama Barang
            <font class="text-green-900">*(Wajib Diisi)</font>
            <input type="text"
                   wire:model="formItem.name"
                   class="input bg-gray-200 pc border-1 border border-gray-100 rounded w-full py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white">
        </div>

        <div class="col-span-6">QTY
            <font class="text-green-900">*(Wajib Diisi)</font>
            <input type="number"
                   wire:model.live="formItem.quantity"
                   class="input bg-gray-200 pc border-1 border border-gray-100 rounded w-full py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white">
        </div>

        <div class="col-span-6">Harga Produk
            <font class="text-green-900">*(Wajib Diisi)</font>
            <input type="number"
                   wire:model.live="formItem.price"
                   class="input bg-gray-200 pc border-1 border border-gray-100 rounded w-full py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white">
        </div>


        <div class="col-span-2">
            Total Harga
        </div>
        @if(is_numeric($formItem['price']) && is_numeric($formItem['quantity']) )
            <div class="col-span-4 font-bold  text-xl">
            Rp. {{ number_format($formItem['price']*$formItem['quantity'],2,',','.') }}
            </div>
        @else

        <div class="col-span-4 font-bold ">
                QTY dan Harga belum input
        </div>

        @endif
        <div class="col-span-6 text-right">
            <br>
            <button type="submit" class="bg-green-900 text-white rounded pt-2 pb-2 pr-5 pl-5">Input Item Transaksi</button>
        </div>


    </form>

</div>
