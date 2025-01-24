<form wire:submit.prevent="create">
    <div class="rounded-xl border shadow-lg p-5">
        <h2 class="text-xl">
            Lihat Produk
        </h2>
        <br>
        <div class="gap-5 lg:grid lg:grid-cols-12 ">
            <div class="flex lg:hidden lg:col-span-6  justify-center text-center ">
                <img src="{{ asset(str_replace('public','storage',$product->photo_product)) }}" alt=""
                     style="max-height: 300px">
            </div>
            <div class="col-span-12 lg:col-span-6 grid-cols-12 grid gap-3">
                <div class="col-span-12 lg:col-span-3 flex mb-2" style="align-items: center;">
                    Nama produk
                </div>
                <div class="col-span-12 lg:col-span-9 mb-2 ">
                    <div
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                        {{ $product->title }}
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-3 mb-2 flex" style="align-items: center;">
                    Kode Produk
                </div>
                <div class="col-span-12 lg:col-span-9 mb-2 ">
                    <div
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                        {{ $product->code }}
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-3 mb-2 flex" style="align-items: center;">
                    Size Produk
                </div>
                <div class="col-span-12 lg:col-span-9 mb-2 ">
                    <div
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                        {{ $product->size }} cm
                    </div>

                </div>

                <div class="col-span-12 lg:col-span-3 mb-2 flex" style="align-items: center;">
                    Stock
                </div>
                <div class="col-span-12 lg:col-span-9 mb-2 ">
                    <div
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                        {{ $product->stock }} pcs
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-3 mb-2 flex align-middle" style="align-items: center;">
                    Process
                </div>
                <div class="col-span-12 lg:col-span-9 mb-2 ">
                    <div
                        class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                        @foreach($product->productProcesses as $process)
                            <span
                                class="px-2 py-1 text-xs bg-wishka-400 text-white rounded-md">{{ $process->productProcessTag->title }}</span>
                        @endforeach

                    </div>
                </div>


            </div>
            <div class="hidden lg:flex lg:col-span-6  justify-center text-center ">
                <img src="{{ asset(str_replace('public','storage',$product->photo_product)) }}" alt=""
                     style="max-height: 300px">
            </div>

            @php
                $total=0;
            @endphp
            <div class="col-span-12 lg:col-span-12 mb-2 overflow-x-auto">
                <table style="width: 100%" class="table-auto table">
                    <tr style="text-align: center" class=" border-blue-300 border-b-2 m-3">
                        <td class="p-2 w-3/12">Nama Bahan</td>
                        <td class="p-2 w-2/12">Jumlah Item</td>
                        <td class="p-2 w-2/12">Size Item</td>
                        <td class="p-2 w-3/12">Keterangan</td>
                        <td class="p-2 w-2/12">HPP Bahan</td>
                    </tr>

                    @foreach($product->productMaterials as $productMaterials)
                        @php
                            $value = 0;
                            if ($productMaterials->material->stock != 0) {
                                $value = $productMaterials->material->value / $productMaterials->material->stock;
                            }
                            $total+=$value;
                        @endphp
                        <tr class="text-center">
                            <td>{{ $productMaterials->material->title }}</td>
                            <td class="{{ $productMaterials->material->stock=0?'text-error':'' }}">{{ $productMaterials->amount.$productMaterials->material->unit }}</td>
                            <td>{{ $productMaterials->size }}</td>
                            <td>{{ $productMaterials->note }}</td>
                            <td>Rp. {{ thousand_format($value) }}</td>
                        </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</form>
