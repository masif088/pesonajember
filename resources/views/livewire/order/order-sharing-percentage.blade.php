<div>
    <form wire:submit="update">
        <table class="text-md" style="width: 100%">
            <tr style="height: 60px">
                <td style="width: 200px !important;">Nama Konsumen</td>
                <td style="width: 20px !important;" class="pr-5 pl-5">:</td>
                <td>{{ $order->customer->name }}</td>
            </tr>
            <tr style="height: 60px">
                <td>Nama Perusahaan</td>
                <td class="pr-5 pl-5">:</td>
                <td>{{ $order->customer->company_name }}</td>
            </tr>

            <tr style="height: 60px">
                <td>Nomer Telepon</td>
                <td class="pr-5 pl-5">:</td>
                <td>{{ $order->customer->phone }}</td>
            </tr>
            <tr style="height: 60px">
                <td>Nominal Nilai Kontrak</td>
                <td class="pr-5 pl-5">:</td>
                <td>
                    Rp. {{ thousand_format($contractValue) }}
                </td>
            </tr>
            <tr style="height: 60px">
                <td>Nominal Pencarian</td>
                <td class="pr-5 pl-5">:</td>
                <td>
                    <div class="align-middle flex justify-between ">
                        <span style="line-height: 38px">Rp. </span>
                        <input type="number" wire:model.live="value"
                               class="input bg-gray-200 pc border-1 border border-gray-100 rounded py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white"
                               style="width: 95%">
                    </div>
                </td>
            </tr>
            <tr style="height: 60px">
                <td>% Sharing</td>
                <td class="pr-5 pl-5">:</td>
                <td>
                    <div class="align-middle flex">
                        <input type="number" step="0.1" wire:model.live="percentage"
                               class="input bg-gray-200 pc border-1 border border-gray-100 rounded py-2 px-4  leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark  focus:dark:border-white"
                               style="width: 10%">
                        <span style="line-height: 38px; margin-left: 20px">%</span>
                    </div>
                </td>
            </tr>
            <tr style="height: 60px">
                <td>Nominal Pendapatan Sharing</td>
                <td class="pr-5 pl-5">:</td>
                <td>
                    @if( is_numeric($value) and is_numeric($percentage))
                        Rp. {{ thousand_format($value*$percentage/100) }}
                    @endif
                </td>
            </tr>
        </table>
        <x-button-submit class="col-span-3 float-right mt-4" title="Konfirmasi Sharing"/>
    </form>




</div>
