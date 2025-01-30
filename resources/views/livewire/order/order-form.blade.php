<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">
    @if($action!="update")
        <div class="mt-3  col-span-12 ">
            <label class="block text-sm text-black dark:text-white mb-1" for="datatransaction_type_id">
                Konsumen/perusahaan telah terdaftar pada system ?
            </label>
            <select id="customerType" wire:model.live="customerType" name="customerType" class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
                <option></option>
                <option value="1" style="padding: 0 25px">
                    Iya
                </option>
                <option value="2" style="padding: 0 25px">
                    Tidak
                </option>
            </select>
        </div>
        @if($customerType==2)
            <x-argon.form-generator repositories="CustomerOrder"/>
        @elseif($customerType==1)
            <x-argon.form-generator repositories="CustomerChoice"/>
        @endif
    @endif

    <div class="@if($customerType!=0) lg:grid @else hidden @endif grid-cols-12 gap-3 mt-3 col-span-12">
        <x-argon.form-generator repositories="Order"/>
    </div>
    <div class="col-span-9"></div>
    @if($customerType!=0 )
        <x-button-submit class="col-span-3 float-right mt-4" title="Simpan"/>
    @endif
</form>
