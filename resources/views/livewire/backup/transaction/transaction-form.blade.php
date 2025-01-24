@php use App\Models\Customer;use App\Models\PaymentModel;use App\Models\Product;use App\Models\TransactionDetailType; @endphp
@php use App\Models\Shipper; @endphp
<div class="rounded-xl border shadow-lg p-5">
    <h2 class="uppercase text-lg">Buat Pesanan</h2>
    <br>

    <div class="lg:grid grid-cols-12 gap-3">
        <div class="col-span-7">
            <div class="mb-2" style="align-items: center;">
                Konsumen
            </div>

            <div class="" wire:ignore>
                <select id="customer" wire:model="customer"
                        style="width: 100%"
                        class="mb-2 bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white select2 select3"
                        multiple=""
                        name=""
                        onchange="customerChange()"
                >
                    @foreach( $optionCustomers as $option)
                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                    @endforeach
                </select>
                <script>
                    document.addEventListener('livewire:init', function () {
                        $('#customer').select2({maximumSelectionLength: 1});
                    });

                    function customerChange() {
                        @this.
                        set(`customer`, $(`#customer`).val()[0]);
                    }

                </script>
            </div>
            <br>
            <a href="{{ route('customer.create') }}" class="col-span-4 btn bg-wishka-500">Tambah ID Konsumen Baru</a>
            <br><br>
        </div>



        <div class="lg:grid grid-cols-12 gap-3 col-span-7">
            <div class="col-span-12">
                <div class="mb-2" style="align-items: center;">
                    Tanggal transaksi
                </div>
                <div class="">
                    <input type="date" wire:model.live="dateTransaction"
                           class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">

                </div>
            </div>
            <div class="col-span-12">
                <div class="mb-2" style="align-items: center;">
                    Payment Model
                </div>
                <div class="" wire:ignore>
                    <select wire:model.live="paymentModel"
                            class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
                            name="">
                        <option value=""></option>
                        @foreach( $optionPaymentModels as $option)
                            <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-span-12">
                <div class="mb-2" style="align-items: center;">
                    Pajak
                </div>
                <div class="">
                    <input type="number" wire:model.live="tax"
                           class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">

                </div>
            </div>
        </div>

    </div>
    <br><br>
    <div class="lg:grid grid-cols-12 gap-3">
        <div class="col-span-4">
            <b>Dari, <br> Wishka</b> <br>
            Sukun, Malang <br>
            [PHONE_NUMBER]/[EMAIL]
        </div>
        <div class="col-span-4"></div>
        <div class="col-span-4 text-end">
            @if($customer!=null)
                <b>Kepada, <br> {{ Customer::find($customer)->name??'' }}</b><br>
                {{ Customer::find($customer)->province??'' }}
                {{ Customer::find($customer)->city??'' }}
                {{ Customer::find($customer)->district??'' }}<br>
                {{ Customer::find($customer)->address??'' }}<br>
                {{ Customer::find($customer)->phone??'' }}
                /{{ Customer::find($customer)->email??'' }}
            @endif
        </div>
    </div>

    <br>
    <b>Detail Pesanan</b>
    <div class="col-span-12 lg:col-span-12 mb-2 overflow-x-auto">
        <table style="width: 100%" class="table-auto table">
            <tr style="" class=" border-blue-300 border-b-2 m-3">
                <td class="p-2 text-center w-[50px]">#</td>
                <td class="p-2">Pesanan</td>
                <td class="p-2 text-center">Jumlah</td>
                <td class="p-2 text-center">Harga Satuan</td>
                <td class="p-2">Total</td>
            </tr>
            @php($total = 0)
            @foreach($transactionLists as $index=>$list)
                <tr class="border-b">
                    <td class="text-center">{{ $index+1 }}</td>
                    <td>
                        @if($list['transaction_detail_type_id']==1)
                            <b>{{ $list['shipper_category'] }} </b><br>
                            {{ Shipper::find($list['shipper_id'])->title }} <br>
                        @elseif($list['transaction_detail_type_id']==2)
                            @php($product =Product::find($list['product_id']) )
                            <b>{{ $product->title }}</b> <br>
                            {{ $product->productCategory->title }} <br>
                            {{ $product->note }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(is_numeric($list['amount']))
                            {{ thousand_format($list['amount']) }}pcs
                        @else
                            {{ $list['amount'] }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(is_numeric($list['amount']))
                            Rp. {{ thousand_format($list['price'])  }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($list['transaction_detail_type_id']==1)
                            @php($total+=$list['price'])
                            Rp. {{ thousand_format($list['price']) }}
                        @elseif($list['transaction_detail_type_id']==2)
                            @php($total+=$list['price']*$list['amount'])
                            Rp. {{ thousand_format($list['price']*$list['amount']) }}
                        @endif
                    </td>

                    <td class="border-none flex flex-row gap-1" style="width: 40px">
{{--                        <div class="flex-1 text-end px-2 py-1 bg-wishka-400 rounded-md">--}}
{{--                            <i class="ti ti-pencil text-xl text-white"></i>--}}
{{--                        </div>--}}
                        <div class="flex-1 text-end px-2 py-1 bg-error rounded-md" wire:click="delete({{$index}})">
                            <i class="ti ti-trash text-xl text-white" ></i>
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr class="border-b">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="border-none flex flex-row gap-3" style="width: 40px">
                    <!-- Popover -->
                    <div class="hs-tooltip inline-block [--placement:bottom] p-1">
                        <div class="hs-tooltip-toggle block text-center">
                            <button type="button" class="flex-1 text-end px-2 py-1 bg-wishka-400 rounded-md">
                                <i class="ti ti-plus text-xl text-white"></i>
                            </button>
                            <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible hidden opacity-0 transition-opacity absolute invisible z-10 max-w-xs bg-white border text-start rounded-md shadow-lg border-wishka-400 ">
                                <div class="p-2 divide-y-2 gap-3">
                                    <div class="p-1" wire:click="productFormLayoutSet">
                                        Produk
                                    </div>
                                    <div class="p-1" wire:click="shipperFormLayoutSet">
                                        Pengiriman
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="border-b">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center"><b>Sub Total</b></td>
                <td><b>Rp. {{ thousand_format($total) }}</b></td>
                <td></td>
            </tr>
            <tr class="border-b">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center"><b>Pajak ({{is_numeric($tax)?$tax:0}}%)</b></td>
                <td><b>Rp. {{ thousand_format($total*(is_numeric($tax)?$tax:0)/100) }}</b></td>
                <td></td>
            </tr>
            <tr class="border-b">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center text-xl"><b>Total</b></td>
                <td class="text-xl"><b>Rp. {{ thousand_format($total+($total*(is_numeric($tax)?$tax:0)/100)) }}</b></td>
                <td></td>
            </tr>
            @if($paymentModel!=null)
                @foreach(explode(':',PaymentModel::find($paymentModel)->model) as $index=>$m)
                    <tr>
                        <td></td>
                        <td>Pembayaran Ke {{$index +1}} ({{ $m }}%):</td>
                        <td>Rp. {{ thousand_format(($total+($total*(is_numeric($tax)?$tax:0)/100))*$m/100) }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endif
        </table>

        <br><br>
        <div class="col-span-12">
            <div class="mb-2" style="align-items: center;">
                Catatan
            </div>
            <div class="">
                <textarea wire:model.live="note"
                          class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"></textarea>

            </div>
        </div>
        <br>
        <div class="grid grid-cols-12">
            <button class="btn bg-error col-span-1">Batal</button>
            <span class="col-span-8"></span>
            <button class="btn bg-wishka-600 col-span-3" wire:click="{{ $action }}">Tambah Transaksi</button>
        </div>
    </div>


    <div class="vh-100 p-5 fixed" wire:click="overlay" style=" @if($shipperFormLayout or $productFormLayout) display: table @else display:none @endif ; overflow: hidden;position: fixed; top: 0; z-index: 3; height: 100%; width: 100%; right: 0; background: #c0c0c0c0"></div>
    <div class="m-5 p-5 bg-white rounded shadow-xl" style="width: 600px;
    @if(!$productFormLayout) display:none @else display:block  @endif ;
        height: 450px;position: fixed;left: 0;right: 0;top: 0;bottom: 0;margin: auto;max-width: 90%;max-height: 100%;z-index: 10;overflow: auto;">
        <div class="absolute top-5 right-5" wire:click="overlay">
            <i class="ti ti-x text-2xl"></i>
        </div>
        <h2 class="text-lg "> Tambah Produk</h2>
        <br>
        <script>
            document.addEventListener('select2dispatch', function () {
                setTimeout(function () {
                    $('.select3').select2({maximumSelectionLength: 1});
                }, 10);
            });

            function size(val, title) {
                @this.
                set(`materialList.${val}.${title}`, $(`#${title}${val}`).value);
            }

            function product() {
                @this.
                set(`transactionList.product_id`, $(`#product`).val()[0]);
            }
        </script>
        <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
            Pesanan :
        </div>
        <div wire:ignore>
            <select id="product" wire:model="transactionList.product_id"
                    style="width: 100%"
                    class="mb-2 bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white select2 select3"
                    multiple=""
                    name=""
                    onchange="product()"
            >
                @foreach( $optionProducts as $option)
                    <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                @endforeach
            </select>
        </div>

        <br>
        <div class="col-span-12  flex mt-1" style="align-items: center;">
            Jumlah Pesanan:
        </div>
        <div class="col-span-12 lg:col-span-4 mb-2 ">
            <input type="number" wire:model.live="transactionList.amount" required
                   class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            <span style="margin-left:-100px;">PCS</span>
        </div>

        <div class="col-span-12 flex" style="align-items: center;">
            Harga Satuan:
        </div>
        <div class="col-span-12 mb-2 ">
            <input type="number" value="" wire:model.live="transactionList.price"
                   class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
        </div>
        <div class="col-span-12 mb-2 flex" style="align-items: center;">
            Total:
        </div>
        <div class="col-span-12 ">

            <input type="text"
                   value="Rp. @if(is_numeric($transactionList['price']) and is_numeric($transactionList['amount'])){{ thousand_format(($transactionList['price']??0)*($transactionList['amount']??0)) }} @endif"
                   disabled
                   class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
        </div>

        <br>
        <div class="col-span-2">
            <button type="button" class="btn bg-wishka-600 " style="width: 100%" wire:click="addTransactionDetail">
                Tambah
            </button>
        </div>
    </div>

    <div class="m-5 p-5 bg-white rounded shadow-xl" style="width: 600px;
    @if(!$shipperFormLayout) display:none @else display:block  @endif ;
        height: 450px;position: fixed;
        left: 0;right: 0;top: 0;bottom: 0;margin: auto;max-width: 90%;max-height: 100%;z-index: 10;overflow: auto;">

        <div class="absolute top-5 right-5" wire:click="overlay">
            <i class="ti ti-x text-2xl"></i>
        </div>

        <h2 class="text-lg "> Tambah Pengiriman</h2>
        <br>
        <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
            Kategori Pengiriman :
        </div>
        <select wire:model.live="transactionList.shipper_category"
                style="width: 100%"
                class="mb-2 bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
                name=""
        >
            @foreach( $optionShipperCategories as $option)
                <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
            @endforeach
        </select>
        <br>
        <div class="col-span-12  flex mt-1" style="align-items: center;">
            Ekpedisi Pengiriman :
        </div>
        <div class="col-span-12 lg:col-span-4 mb-2 ">
            <select id="product" wire:model.live="transactionList.shipper_id"
                    style="width: 100%"
                    class="mb-2 bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
                    name=""
            >
                <option value=""></option>
                @foreach( $optionShippers as $option)
                    <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-span-12 flex" style="align-items: center;">
            Berat (perkiraan berat):
        </div>
        <div class="col-span-12 mb-2 ">
            <input type="text" wire:model="transactionList.amount"
                   class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
        </div>
        <div class="col-span-12 mb-2 flex" style="align-items: center;">
            Biaya kirim (perkiraan harga):
        </div>
        <div class="col-span-12 ">
            <input type="number" wire:model="transactionList.price"
                   class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
        </div>

        <br>
        <div class="col-span-2">
            <button type="button" class="btn bg-wishka-600 " style="width: 100%" wire:click="addTransactionDetail">
                Tambah
            </button>
        </div>
    </div>
</div>
