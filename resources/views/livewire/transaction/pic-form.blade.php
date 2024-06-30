<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">
{{--    <x-argon.form-generator repositories="Bank"/>--}}

    <div class="col-span-12 grid">
        <label class="block text-sm text-black dark:text-white mb-1" for="mockup2">
            Person In Charge
        </label>
        <select wire:model="form" id="mockup2"
                class="col-span-12 text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
            @foreach($optionUser as $o)
                <option value="{{ $o['value'] }}">{{ $o['title'] }}</option>
            @endforeach

        </select>
    </div>
    <label for="" class="col-span-12">
        <input type="checkbox" class="border-1 rounded-sm" wire:model="checkbox"> Tambah pic baru
    </label>

    <div class="col-span-9"></div>
    <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Submit</button>
</form>
