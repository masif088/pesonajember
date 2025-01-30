<div class="grid grid-cols-12 gap-3">
    <form wire:submit="{{$action}}" class="col-span-12">
        <table>
            <tr style="height: 50px">
                <td>Nama Konsumen</td>
                <td style="width: 100px"></td>
                <td>{{ $order->customer->name }}</td>
            </tr>
            <tr style="height: 50px">
                <td>Nama Perusahaan</td>
                <td style="width: 100px"></td>
                <td>{{ $order->customer->company_name }}</td>
            </tr>
        </table>
        <br>
        <h5 class="text-xl uppercase">List Surat Jalan</h5>
        <br>
        <table class="table w-full">
            <thead class="border-b-2 font-bold">
            <tr>
                <td>No</td>
                <td>Nama barang</td>
                <td class="text-center">QTY Tersisa</td>
                <td class="text-center">QTY Yang akan dikirim</td>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderProducts as $index=>$op)
                <tr style="height: 50px;" class="border-b-2">
                    <td class="align-top py-2">{{ $index+1 }}</td>
                    <td class="align-top py-2">{{ $op->name }}</td>
                    <td class="align-top py-2 text-center">{{ thousand_format($op->quantity-$op->orderProductOutDetails->sum('quantity')) }}</td>
                    <td class="align-top py-2 text-center">
                        <input type="number" style="width: 200px" wire:model="form.orderProduct.{{$op->id}}"
                               class="input bg-gray-200 pc border-1 border border-gray-100 rounded w-full py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white text-right" >
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <div class="">
            <label class="block text-sm text-black dark:text-white mb-1" for="note">
                Note
            </label>
            <textarea id="note" rows="5" wire:model="form.note"
                      class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white"></textarea>
        </div>

        <button class="bg-green-900 hover:bg-green-200 text-white px-6 py-2 rounded flex-nowrap text-nowrap float-right mt-5" >Cetak Barang Keluar dan Surat Jalan</button>
    </form>
</div>
