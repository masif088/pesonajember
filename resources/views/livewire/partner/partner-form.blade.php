<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">
    <div class="col-span-12 text-xs">
        Note untuk format number <br>
        <ul class="columns-2">

            <li>[DATE] : untuk tanggal dengan format 01-30</li>
            <li>[DATEROMAN] : untuk tanggal dengan format romawi</li>
            <li>[MONTH] : untuk bulan dengan format 01-12</li>
            <li>[MONTHROMAN] : untuk bulan dengan format romawi</li>
            <li>[YEAR] : untuk tahun dengan format XXXX</li>
            <li>[YEARROMAN] : untuk tahun dengan format romawi</li>
            <li>[NUMBER] : untuk urutan, urutan direset setiap hari</li>
        </ul>
    </div>
    <x-argon.form-generator repositories="Partner"/>
    <div class="col-span-9"></div>
    <x-button-submit class="col-span-3 float-right mt-4" title="Simpan"/>
</form>
