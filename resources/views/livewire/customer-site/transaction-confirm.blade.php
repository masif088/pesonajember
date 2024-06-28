<div class="grid grid-cols-12 gap-3">
    <h2 class="text-2xl col-span-12 mb-10">
        {{ $transaction->transactionStatus->transactionStatusType->title??'' }}
    </h2>

    <form wire:submit="update" class="col-span-12 lg:col-span-6">
        <div class="col-span-12">
            <label class="block text-sm text-black dark:text-white mb-1" for="status">
                Status
            </label>

            <select wire:model="status" id="status"
                    class="mb-2 bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
                    name="">
                <option value=""></option>
                <option value="Disetujui">Disetujui</option>
                <option value="Revisi">Revisi</option>
            </select>
        </div>

        <div class="col-span-12">
            <label class="block text-sm text-black dark:text-white mb-1" for="note">
                Catatan
            </label>
            <textarea wire:model="note" id="note" class="mb-2 bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"></textarea>
        </div>
        <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Submit</button>
    </form>

    <div class="col-span-12 lg:col-span-6">
        <object data="{{ asset('storage'.str_replace('public','',$transaction->transactionStatus->transactionStatusAttachments->where('key','pdf mockup')->first()->value??'')) }}"
                type="application/pdf" style="width: 100%; height: 80vh">
            <a href="{{ asset('storage'.str_replace('public','',$transaction->transactionStatus->transactionStatusAttachments->where('key','pdf mockup')->first()->value??'')) }}">test.pdf</a>
        </object>
    </div>

</div>
