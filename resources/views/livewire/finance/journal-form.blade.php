<form wire:submit.prevent="create">
    <div class="rounded-xl border shadow-lg p-5">
        <h2 class="text-xl">
            Tambah Jurnal
        </h2>
        <br>
        <div class="gap-5 lg:grid lg:grid-cols-12">
            <div class="col-span-12 lg:col-span-2 flex mb-2" style="align-items: center;">
                Jumlah Input Jurnal
            </div>
            <div class="col-span-12 lg:col-span-4 mb-2 ">
                <input type="number" wire:model.live="number" required onchange="setNumber()"
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            </div>
            <div class="col-span-12 lg:col-span-2 flex mb-2" style="align-items: center;">
                Tanggal
            </div>
            <div class="col-span-12 lg:col-span-4 mb-2 ">
                <input type="date" wire:model.live="date" required
                       class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
            </div>
            <script>
                function setNumber() {
                    @this.setNumber()
                }
            </script>
        </div>

        @for($i=0; $i<$number; $i++)
            <br>
            <div class="gap-5 lg:grid lg:grid-cols-12">
                <div wire:ignore class="col-span-5">
                    Kode Jurnal
                    <select
                        id="account_journal_id_{{$i}}"
                        onchange="journal({{$i}})"
                            class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white select2 select3"
                            multiple=""
                            name=""
                    >
                        @foreach( $optionAccountNames as $option)
                            <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div wire:ignore class="col-span-2">
                    Debet
                    <input type="number" wire:model.live="journal.{{$i}}.debit"
                           class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                </div>
                <div wire:ignore class="col-span-2">
                    Kredit
                    <input type="number" wire:model.live="journal.{{$i}}.credit"
                           class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                </div>
                <div wire:ignore class="col-span-3">
                    Keterangan
                    <input type="text" wire:model.live="journal.{{$i}}.note"
                           class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white">
                </div>
            </div>
        @endfor

        <br><br>
        <button class="btn bg-wishka-700 col-span-2 lg:col-span-3  mb-3 float-right" style="padding: 10px 50px">Input data</button>
        <br><br>



    </div>
    <script>
        document.addEventListener('select2dispatch', function () {
            setTimeout(function () {
                $('.select3').select2({
                    maximumSelectionLength: 1
                });
            }, 10);
        });
        function journal(val) {
            @this.
            set(`journal.${val}.account_name_id`, $(`#account_journal_id_${val}`).val());
        }
    </script>




</form>
