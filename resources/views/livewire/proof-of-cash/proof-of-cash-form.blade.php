<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">
    @if($partnerId==null)
    <div class="col-span-12">Pilih CV
        <font class="text-green-900">*(Wajib Diisi)</font>

        <select id="partner_id" wire:model.live="form.partner_id" name="partner_id" class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
            <option></option>
            @foreach($partners as $p)
                <option value="{{ $p->partner_id }}" style="padding: 0 25px">
                    {{ $p->partner->name }}
                </option>
            @endforeach
        </select>
    </div>
    @endif


    <x-argon.form-generator repositories="ProofOfCash" />
    <div class="col-span-9"></div>
    <x-button-submit class="col-span-3 float-right mt-4" title="Simpan"/>
</form>
