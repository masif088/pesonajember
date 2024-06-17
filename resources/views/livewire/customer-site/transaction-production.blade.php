<div class="lg:grid grid-cols-12">
    <div class="col-span-12">
        <h2 class="text-2xl mb-2">Traking Produksi</h2>
        <br>
        <div class="text-md md:w-12/12 lg:w-12/12 p-3 flex flex-fill font-bold ml-auto justify-between"
             style="border-radius: 10px 10px 0 0;">
            <table style="width: 100%">
                <tr>
                    <td>No Invoice : {{ $transaction->uid }}</td>
                    <td></td>
                    <td style="text-align: right">
                        Tanggal : {{ get_date_format($transaction->created_at) }}</td>
                </tr>
            </table>
        </div>
        <div class="p-3 w-12/12 text-md">
            <table class="w-full p-3">
                <tr>
                    <td>
                        <b>Dari, <br> Wishka Company</b> <br>
                        Vendor Tas Malang <br>
                        Jl Mayar No 30, Sukun, Kota Malang <br>
                        + 62 812 5268 7268 / +62 895 3372 63639
                    </td>
                    <td></td>
                    <td style="text-align: right">
                        <b>Kepada,</b> <br>
                        <b>{{ $transaction->customer->name }}</b> <br>
                        {{ $transaction->customer->address }} <br>
                        {{ $transaction->customer->phone }}
                    </td>
                </tr>
            </table>
        </div>
        <br>

        <div class="lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">
            <livewire:customer-site.transaction-delivery :transaction-id="$transactionId"/>
            <!--Recent Transactions Card End-->
        </div>

    </div>
</div>
