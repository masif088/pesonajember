<form wire:submit="create" class="lg:grid grid-cols-12 gap-3">

    <div class="col-span-12 grid">
        <label class="block text-sm text-black dark:text-white mb-1" for="mockup">
            Proses Print/Sablon/DTF/Polosan
        </label>
        <select wire:model="process"
            class="col-span-12 text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
            <option value=""></option>
            <option value="Print">Print</option>
            <option value="Sablon">Sablon</option>
            <option value="DTF">DTF</option>
            <option value="Polosan">Polosan</option>
        </select>
{{--        <input wire:model="form" id="mockup"--}}
{{--               class="col-span-12 text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white"--}}
{{--               type="text" placeholder="Person In Charge">--}}

    </div>


    <div class="col-span-12 grid">
        <label class="block text-sm text-black dark:text-white mb-1" for="mockup">
            Mockup
        </label>
        <input wire:model="mockup" id="mockup"
               class="col-span-12 text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white"
               type="file" placeholder="Mockup">
        @if ($mockup)
            Mockup Preview:
            <img src="{{ $mockup->temporaryUrl() }}" alt="" style="max-width: 150px;max-height: 300px">
        @endif
        <div wire:loading wire:target="mockup">Uploading...</div>
    </div>

{{--    <x-argon.form-generator repositories="Bank"/>--}}
{{--    <div class="col-span-9"></div>--}}
    <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Tambah Mockup</button>
</form>
