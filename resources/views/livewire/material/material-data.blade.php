<div class="gap-5 lg:grid lg:grid-cols-12">
    <div class="col-span-12 lg:col-span-2 flex mb-2" style="align-items: center;">
        Nama material
    </div>
    <div class="col-span-12 lg:col-span-4 mb-2 ">
        <input type="text"
               class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
               value="{{ $material->title }}" disabled>
    </div>

    <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
        Harga Rata-rata
    </div>
    <div class="col-span-12 lg:col-span-4 mb-2 ">
        <input type="text"
               class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
               value="{{ $material->stock==0?'-':'Rp. '.thousand_format($material->value/$material->stock) }}" disabled>

    </div>

    <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
        Kode Material
    </div>
    <div class="col-span-12 lg:col-span-4 mb-2 ">
        <input type="text"
               class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
               value="{{ $material->code }}" disabled>
    </div>

    <div class="col-span-12 lg:col-span-2 mb-2 flex" style="align-items: center;">
        Stock Sekarang
    </div>
    <div class="col-span-12 lg:col-span-4 mb-2 ">
        <input type="text"
               class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
               value="{{ thousand_format($material->stock) }}" disabled>
        <span style="margin-left:-50px;">PCS</span>
    </div>

</div>
