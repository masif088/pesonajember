<form wire:submit="create" class="lg:grid grid-cols-12 gap-3">
    <x-argon.form-generator repositories="MailHistory"/>
    <div class="mt-3 grid grid-cols-12 col-span-12">
        <label class="col-span-2 block text-sm text-black dark:text-white mb-1" for="file1">File 1</label>
        <input type="file" wire:model="file1" class="col-span-4">
    </div>
    <div class="mt-3 grid grid-cols-12 col-span-12">
        <label class="col-span-2 block text-sm text-black dark:text-white mb-1" for="file1">File 2</label>
        <input type="file" wire:model="file2" class="col-span-4">
    </div>
    <div class="mt-3 grid grid-cols-12 col-span-12">
        <label class="col-span-2 block text-sm text-black dark:text-white mb-1" for="file1">File 3</label>
        <input type="file" wire:model="file3" class="col-span-4">
    </div>
    <div class="col-span-9"></div>
    <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Kirim email</button>
</form>
