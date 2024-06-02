<form wire:submit="create" class=" gap-5 grid lg:grid-cols-12">
    <div class="col-span-2 flex mb-2" style="align-items: center;">
        Tanggal
    </div>

    <div class="col-span-10 mb-2 flex">
        <span style="width: 5%; align-items: center" class="flex text-center">:</span>
        <input type="date" style="width: 95%;"
               wire:model="date"
               class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
    </div>
    <div class="col-span-2 flex mb-2" style="align-items: center;">
        Keterangan
    </div>

    <div class="col-span-10 mb-2 flex">
        <span style="width: 5%; align-items: center" class="flex text-center">:</span>
        <input type="text" style="width: 95%;" wire:model="note"
               class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
               required>
    </div>

    <div class="col-span-2 flex mb-2" style="align-items: center;">
        Perubahan Stock
    </div>

    <div class="col-span-10 mb-2 flex">
        <span style="width: 5%; align-items: center" class="flex text-center">:</span>
        <select style="width: 30%;" wire:model="mutation_status"
                class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            @foreach($optionMutationStatus as $option)
                <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
            @endforeach

        </select>

        <span style="width: 2%; align-items: center" class="flex text-center"></span>
        <input type="text" style="width: 63%;" wire:model="amount"
               class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
    </div>
    <div class="col-span-9"></div>
    <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Tambah Material</button>
</form>
