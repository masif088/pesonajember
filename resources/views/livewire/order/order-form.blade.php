<form wire:submit="{{ $action }}" class="lg:grid grid-cols-12 gap-3">
    @if($action!="update")
        <div class="mt-3  col-span-12 ">
            <label class="block text-sm text-black dark:text-white mb-1" for="datatransaction_type_id">
                Konsumen/perusahaan telah terdaftar pada system ?
            </label>
            <select id="customerType" wire:model.live="customerType" name="customerType"
                    class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
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
            @if($transaction_type_id==3)
                <x-argon.form-generator repositories="CustomerOrderFlag"/>
            @else
                <x-argon.form-generator repositories="CustomerOrder"/>
            @endif
        @elseif($customerType==1)

            @if($transaction_type_id==3)
                <x-argon.form-generator repositories="CustomerChoiceFlag"/>
            @else
                <x-argon.form-generator repositories="CustomerChoice"/>
            @endif
        @endif

        @if($transaction_type_id==3 and $customerType!=0)
            <div class="mt-3  col-span-12 font-bold">
                Konsumen Transaksi
            </div>
            @if($customerType==2)
                <x-argon.form-generator repositories="CustomerOrderFlag2"/>
            @else
                <div class="mt-3  col-span-12 ">
                    <label class="block text-sm text-black dark:text-white mb-1" for="datatransaction_type_id">
                        Konsumen transaksi telah terdaftar pada system ?
                    </label>
                    <select id="customerType" wire:model.live="customerType2" name="customerType2"
                            class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
                        <option></option>
                        <option value="1" style="padding: 0 25px">
                            Iya
                        </option>
                        <option value="2" style="padding: 0 25px">
                            Tidak
                        </option>
                    </select>
                </div>
                @if($customerType2==1)
                    <div class="mt-3  col-span-12 ">
                        <label class="block text-sm text-black dark:text-white mb-1" for="customer_id2">
                            Nama konsumen
                        </label>
                        <select id="customerType" wire:model.live="form.customer_id2" name="customer_id2"
                                class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
                            <option></option>
                            @foreach($companyChild as $param)
                                <option value="{{ $param->id }}" style="padding: 0 25px">
                                    {{ $param->company_name." - ".$param->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @elseif($customerType2==2)
                    <x-argon.form-generator repositories="CustomerOrderFlag2"/>
                @endif
            @endif
        @endif

    @else
        <div class="mt-3  col-span-12 ">
            <label class="block text-sm text-black dark:text-white mb-1" for="status">
                Ubah Status
            </label>
            <select id="status" wire:model.live="status" name="status"
                    class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white">
                <option value="0" style="padding: 0 25px">
                    Draft
                </option>
                <option value="1" style="padding: 0 25px">
                    Aktif
                </option>
                <option value="2" style="padding: 0 25px">
                    Cancel
                </option>
                <option value="3" style="padding: 0 25px">
                    Selesai
                </option>
            </select>
        </div>

    @endif

    @if($transaction_type_id==3 and $customerType!=0)
        <div class="col-span-12">
            Nanti ada lagi form pembelinya
        </div>
    @endif

    <div class="mt-3 col-span-12 " wire:ignore>
        <label for="dataPartners"
               class="block text-sm font-bold dark:text-light">
            CV/Partner
        </label>
        <select id="dataPartners"
                class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white select2"
                multiple=""

                name="dataPartners"
                style="padding:0  100px;width: 100%"
                wire:model.live="form.partners">
            @for($i=0;$i<count($partners);$i++)
                <option value="{{ $partners[$i]['value'] }}"
                        style="padding: 0 25px"
                        wire:key="{{$partners[$i]['title']}}" {{ in_array($partners[$i]['value'],$form['partners'])?'selected':''}}>
                    {{$partners[$i]['title']}}
                </option>
            @endfor
        </select>
        <script>
            document.addEventListener('livewire:init', () => {
                let data;
                $('#dataPartners').select2();

                $('#dataPartners').on('change', function (e) {
                    data = $('#dataPartners').select2("val");
                    @this.
                    set('form.partners', data);

                })
            });
        </script>
    </div>

    {{--        @props(['repository'])--}}


    <div class="@if($customerType!=0) lg:grid @else hidden @endif grid-cols-12 gap-3 mt-3 col-span-12">
        <x-argon.form-generator repositories="Order"/>
        @if($transaction_type_id!=3 and $customerType!=0)
            <x-argon.form-generator repositories="OrderTax"/>
        @endif

    </div>
    <div class="col-span-9"></div>
    @if($customerType!=0 )
        <x-button-submit class="col-span-3 float-right mt-4" title="Simpan"/>
    @endif
</form>
