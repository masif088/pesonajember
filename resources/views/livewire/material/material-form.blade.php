<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">

    <x-argon.form-generator repositories="Material" action="{{ $action }}"/>
    @if($action=="create")
        <div class="col-span-12">
            <br>
            Harga beli keseluruhan :

                Rp. {{ thousand_format($form['valueUnit']*$form['stock']) }}


        </div>
    @endif
    <div class="col-span-9"></div>
    <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Tambah Material</button>
</form>
