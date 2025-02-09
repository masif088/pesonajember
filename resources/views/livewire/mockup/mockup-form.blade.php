<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">
    <x-argon.form-generator repositories="Mockup"/>
    <div class="col-span-9"></div>
    <x-button-submit class="col-span-3 float-right mt-4" title="Simpan"/>
</form>
