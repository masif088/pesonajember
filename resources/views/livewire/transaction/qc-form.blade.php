<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">
    {{--    <x-argon.form-generator repositories="Bank"/>--}}
    <div class="col-span-12 grid">
        <label class="block text-sm text-black dark:text-white mb-1" for="mockup2">
            Quality Control
        </label>
        <select wire:model="form" id="mockup2"
                class="col-span-12 text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
            <option value="Sesuai standart">Sesuai standart</option>
            <option value="Perlu perbaikan">Perlu perbaikan</option>
        </select>
        {{--        <input --}}
        {{--               type="text" placeholder="Person In Charge">--}}

    </div>
    <div class="col-span-12 grid">
        <label class="block text-sm text-black dark:text-white mb-1" for="mockup">
            Catatan
        </label>
        <textarea wire:model="form2" id="mockup"
               class="col-span-12 text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white"
               type="text" placeholder="Catatan"></textarea>

    </div>



    <div class="col-span-9"></div>
    <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Submit</button>
</form>
