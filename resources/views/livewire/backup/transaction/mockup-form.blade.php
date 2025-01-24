<form wire:submit="create" class="lg:grid grid-cols-12 gap-3">

    <div class="col-span-12 grid">
        <label class="block text-sm text-black dark:text-white mb-1" for="mockupCustomer">
             Mockup (.pdf)
        </label>
        <input wire:model="mockupCustomer" id="mockupCustomer"
               class="col-span-12 text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white"
               type="file" placeholder="Mockup customer" accept="application/pdf">
        @if ($mockupCustomer)
            File berhasil terupload
        @endif
        <div wire:loading wire:target="mockupCustomer">Uploading...</div>
    </div>

{{--    <x-argon.form-generator repositories="Bank"/>--}}
{{--    <div class="col-span-9"></div>--}}
    <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Submit</button>
</form>
