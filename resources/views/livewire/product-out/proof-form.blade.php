<div class="grid grid-cols-12 gap-3">
    <form wire:submit="uploadFile" class="col-span-12">
        <table >
            <tr style="height: 50px">
                <td>Bukti Barang Keluar</td>
                <td style="width: 100px"></td>
                <td>
                    <input wire:model="poProduct" accept="image/*, .pdf" type="file" class="input bg-gray-200 pc border-1 border border-gray-100 rounded w-full py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white text-right"  value="0">
                </td>
            </tr>
            <tr style="height: 50px">
                <td>Bukti Surat Jalan</td>
                <td style="width: 100px"></td>
                <td>
                    <input wire:model="poWaybill" accept="image/*, .pdf" type="file" class="input bg-gray-200 pc border-1 border border-gray-100 rounded w-full py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white text-right"  value="0">
                </td>
            </tr>
        </table>
        <button class="bg-green-900 hover:bg-green-200 text-white px-6 py-2 rounded flex-nowrap text-nowrap float-right mt-5" >Selesai dan Simpan</button>
    </form>

    <div class="col-span-6">
        @if($poProduct)
            <img src="{{ $poProduct->temporaryUrl() }}" alt="" style="width: 100%">
        @endif
    </div>
    <div class="col-span-6">
        @if($poWaybill)
            <img src="{{ $poWaybill->temporaryUrl() }}" alt="" style="width: 100%">
        @endif
    </div>

</div>
