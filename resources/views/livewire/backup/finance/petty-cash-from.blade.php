<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">
    <x-argon.form-generator repositories="PettyCash"/>
    <div class="col-span-9"></div>
    <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Submit</button>
</form>
