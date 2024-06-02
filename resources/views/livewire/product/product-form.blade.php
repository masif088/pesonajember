<form wire:submit.prevent="create">
    <div class="rounded-xl border shadow-lg p-5">
        <h2 class="text-xl">
            Tambah Produk
        </h2>
        <br>
        <div class="gap-5 lg:grid lg:grid-cols-12">
            <div class="col-span-12 lg:col-span-2 flex mb-2" style="align-items: center;">
                Nama produk
            </div>
            <div class="col-span-12 lg:col-span-4 mb-2 ">
                <input type="text" wire:model="form.title" required
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            </div>

            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Size Produk
            </div>
            <div class="col-span-12 lg:col-span-4 mb-2 ">
                <input type="text" wire:model="form.size" required
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                <span style="margin-left:-50px;">CM</span>
            </div>

            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Kode Produk
            </div>
            <div class="col-span-12 lg:col-span-4 mb-2 ">
                <input type="text" wire:model="form.code" required
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            </div>

            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Kategori
            </div>
            <div class="col-span-12 lg:col-span-4 mb-2 " wire:ignore>
                <select wire:model="form.product_category_id" required
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
                        name=""
                >
                    <option></option>
                    @foreach( $optionCategory as $option)
                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                    @endforeach
                </select>

            </div>

            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Proses
            </div>
            <div class="col-span-12 lg:col-span-10 mb-2 " wire:ignore>
                <select id="category" wire:model="tagsSelected"
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white select2"
                        multiple=""
                        name=""
                >
                    @foreach( $optionTags as $option)
                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                    @endforeach
                </select>
                <script>
                    document.addEventListener('livewire:init', function () {
                        $('#category').select2();

                        $('#category').on('change', function (e) {
                            data = $('#category').select2("val");
                            @this.set('tagsSelected', data);
                        })
                    });
                </script>
            </div>

            <script>

                document.addEventListener('select2dispatch', function () {
                    setTimeout(function () {
                        $('.select3').select2({
                            maximumSelectionLength: 1
                        });
                    }, 10);
                });

                function size(val, title) {
                    @this.
                    set(`materialList.${val}.${title}`, $(`#${title}${val}`).value);
                }
                function cost(val, title) {
                    @this.
                    set(`costList.${val}.${title}`, $(`#${title}${val}`).value);

                }

                function material_id(val) {
                    @this.
                    set(`materialList.${val}.material_id`, $(`#material${val}`).val());
                }
                function account_name_id(val) {
                    @this.
                    set(`costList.${val}.account_name_id`, $(`#cost${val}`).val());
                }

            </script>


            <div class="col-span-12 lg:col-span-12 mb-2 overflow-x-auto">
                <table style="width: 100%" class="table-auto table">
                    <tr style="text-align: center" class=" border-blue-300 border-b-2 m-3">
                        <td class="p-2 w-3/12">Nama Bahan</td>
                        <td class="p-2 w-2/12">Jumlah Item</td>
                        <td class="p-2 w-2/12">Size Item</td>
                        <td class="p-2 w-3/12">Keterangan</td>
                        <td class="p-2 w-2/12">HPP Bahan</td>
                    </tr>
                    @php($countValue=0)
                    @for($j=0; $j<$materialCount;$j++)
                        <tr>
                            <td class="p-2" wire:ignore>
                                <select id="material{{$j}}" wire:model="materialList.{{$j}}.material_id"
                                        style="width: 100%"
                                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white select2 select3"
                                        multiple=""
                                        name=""
                                        onchange="material_id({{$j}})"
                                >
                                    @foreach( $optionMaterial as $option)
                                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="p-2" wire:ignore>
                                <input type="number" wire:model="materialList.{{$j}}.amount"
                                       id="amount{{$j}}"
                                       style="min-width: 120px !important;"
{{--                                       oninput="size({{$j}},'amount')"--}}
                                       class="bg-gray-200 text-center appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                            </td>


                            <td class="p-2" >
                                <input type="number" wire:model.live="materialList.{{$j}}.size"
                                       id="size{{$j}}"
                                       style="min-width: 120px !important;"
{{--                                       oninput="size({{$j}},'size')"--}}
                                       class="bg-gray-200 text-center appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">

                                <span style="margin-left: -70px">
                                    @if($materialList[$j]['material_id']!=null)
                                        {{ $listMaterialUnit[$materialList[$j]['material_id'][0]] }}
                                    @endif
                                </span>
                            </td>

                            <td>
                                <input type="text" wire:model.live="materialList.{{$j}}.note"
                                       id="note{{$j}}"
{{--                                       oninput="size({{$j}},'note')"--}}
                                       class="bg-gray-200 text-start appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                            </td>

                            <td class="p-2 text-right" style="width: 15%">
                                Rp.
                                @if($materialList[$j]['material_id']!=null &&  is_numeric($materialList[$j]['amount']) && is_numeric($materialList[$j]['size']))
                                    @php($countValue+=$listMaterial[$materialList[$j]['material_id'][0]]*$materialList[$j]['amount']*$materialList[$j]['size'])
                                    {{ thousand_format($listMaterial[$materialList[$j]['material_id'][0]]*$materialList[$j]['amount']*$materialList[$j]['size']) }}
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                    @endfor

                    <tr>
                        <td class="p-2">
                            <button type="button" class="btn bg-wishka-600" style="width: 100%" wire:click="addMaterialCount()">Tambah
                                item
                            </button>
                        </td>
                        <td></td>
                        <td></td>

                        <td class="text-end text-xl"><b>TOTAL</b></td>
                        <td class="text-end text-xl"><b>Rp. {{ thousand_format($countValue) }}</b></td>
                    </tr>
                </table>


            </div>

            <div class="col-span-12 lg:col-span-12 mb-2 overflow-x-auto ">
                <table style="width: 100%" class="table table-auto">
                    <tr style="text-align: center" class="border-blue-300 border-b-2 m-3">
                        <td class="p-2 w-4/12">Eksternal cost</td>
                        <td class="p-2" >Jumlah</td>
                        <td class="p-2"  >Harga</td>
                        <td class="p-2 " >Catatan</td>
                        <td class="p-2 ">Total</td>
                    </tr>
                    @php($countValueCost=0)
                    @for($j=0; $j<$costCount;$j++)
                        <tr>
                            <td class="p-2" wire:ignore>
                                <select id="cost{{$j}}" wire:model="costList.{{$j}}.account_name_id"
                                        style="width: 100%"
                                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white select2 select3"
                                        multiple=""
                                        name=""
                                        onchange="account_name_id({{$j}})"
                                >
                                    @foreach( $listCost as $option)
                                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="p-2" wire:ignore>
                                <input type="number" wire:model.live="costList.{{$j}}.amount"
                                       id="costListAmount{{$j}}"
                                       style="min-width: 120px !important;"
{{--                                       oninput="cost({{$j}},'costListAmount')"--}}
                                       class="bg-gray-200 text-center appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                            </td>


                            <td class="p-2" >
                                <input type="number" wire:model.live="costList.{{$j}}.price"
                                       id="costListPrice{{$j}}"
                                       style="min-width: 180px !important;"
{{--                                       oninput="cost({{$j}},'costListPrice')"--}}
                                       class="bg-gray-200 text-center appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                            </td>
                            <td>
                                <input type="text" wire:model.live="costList.{{$j}}.note"
                                       id="costNote{{$j}}"
{{--                                       oninput="cost({{$j}},'costNote')"--}}
                                       class="bg-gray-200 text-start appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                            </td>

                            <td class="p-2 text-right" style="width: 15%">
                                Rp.
                                @if($costList[$j]['account_name_id']!=null &&  is_numeric($costList[$j]['amount']) && is_numeric($costList[$j]['price']))
                                    @php($countValueCost+=$costList[$j]['amount']*$costList[$j]['price'])
                                    {{ thousand_format($costList[$j]['amount']*$costList[$j]['price']) }}
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                    @endfor
                    <tr>
                        <td class="p-2">
                            <button type="button" class="btn bg-wishka-600" style="width: 100%" wire:click="addCostCount()">Tambah item</button>
                        </td>
                        <td></td><td></td>
                        <td class="text-end text-xl"><b>TOTAL</b></td>
                        <td class="text-end text-xl"><b>Rp. {{ thousand_format($countValueCost) }}</b></td>
                    </tr>
                </table>
            </div>

            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Harga pokok penjualan
            </div>
            <div class="col-span-12 lg:col-span-10 mb-2 ">
                <input type="text" value="{{ "Rp. ". thousand_format($countValue+$countValueCost) }}"
                       disabled
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            </div>
            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Harga Jual
            </div>
            <div class="col-span-12 lg:col-span-10 mb-2 ">
                <input type="number" wire:model="form.price"
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            </div>
            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Keaktifan
            </div>
            <div class="col-span-12 lg:col-span-10 mb-2 ">
                <select name="" id="" wire:model="form.status_id"
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                    <option value="1">Aktif</option>
                    <option value="2">Tidak aktif</option>
                </select>
            </div>
            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Galeri Produk
            </div>
            <div class="col-span-12 lg:col-span-10 mb-2 ">
                <select name="" id="" wire:model="form.display_status"
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                    <option value="1">Ditampilkan</option>
                    <option value="2">Tidak ditampilkan</option>
                </select>
            </div>
            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Custom/Product stock
            </div>
            <div class="col-span-12 lg:col-span-10 mb-2 ">
                <select name="" id="" wire:model="form.custom_status"
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                    <option value="1">Custom</option>
                    <option value="0">Product stock</option>
                </select>
            </div>

            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
               Catatan
            </div>
            <div class="col-span-12 lg:col-span-10 mb-2 ">
                <input type="text" wire:model="form.note"
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            </div>

            <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
                Gambar untuk display
            </div>
            <div class="col-span-12 lg:col-span-4 mb-2 ">
                <input type="file" wire:model="thumbnail"
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                <div wire:loading wire:target="thumbnail">Uploading...</div>
            </div>

            <div class="col-span-12 lg:col-span-12 mb-2 lg:grid lg:grid-cols-12">
                <a href="{{ route('production.index') }}" class="btn btn-error col-span-12 lg:col-span-3 mb-3" style="width: 100%">Batal</a>
                <div class=" lg:col-span-6 col-span-12"></div>
                <button class="btn bg-wishka-700 col-span-12 lg:col-span-3  mb-3" style="width: 100%">Tambah</button>
            </div>


        </div>
    </div>


</form>
