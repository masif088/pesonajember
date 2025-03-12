<div>
    <table class="text-lg">
        <tr>
            <td>Nama Konsumen</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->name }}</td>
        </tr>
        <tr>
            <td>Nama Perusahaan</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->company_name }}</td>
        </tr>

        <tr>
            <td>Nomer Telepon</td>
            <td class="pr-5 pl-5">:</td>
            <td>{{ $order->customer->phone }}</td>
        </tr>
    </table>
    <br>
    <hr>
    <br>

    <livewire:order.order-preview-details :order-id="$orderId"/>


    <div>
        <table class="lg:w-full">
            @php
                $allContractValue=$order->orderProducts->sum('value');
                $afterTax=0;
                $dpp=0;
                foreach ($order->orderProducts as $op){
                    $dpp =$op->value*100/(100+$ppn);
                    $ppnProduct = $op->value - $dpp;
                    $pphProduct = $op->pph*$dpp/100;
                    $afterTax += ($dpp - $pphProduct);
                }



                                    if ($type!=3){
                                        $recaps = [
                                        ['title'=>'Nominal Keseluruhan Nilai Kontrak','value'=>$allContractValue],
                                        ['title'=>'TOTAL DPP/TNP PPN','value'=>$dpp],
                                        ['title'=>"TOTAL PPN ($ppn%)",'value'=>$ppnProduct],
                                        ['title'=>"TOTAL PPH ($pph%)",'value'=>$pphProduct],
                                        ['title'=>"TOTAL NOMINAL SETELAH PAJAK",'value'=>$afterTax],
                                        ];
                                    }else{
                                        $recaps = [
                                        ['title'=>'Nominal Keseluruhan Nilai Kontrak','value'=>$allContractValue],

                                        ];
                                    }

            @endphp

            @foreach($recaps as $recap)
                <tr style="height: 50px">
                    <td style="width: 300px">{{ $recap['title'] }}</td>
                    <td></td>
                    <td>
                        <div class="bg-gray-200 rounded text-black p-2 justify-between flex">
                            <span>Rp. </span>
                            <span>
                                        {{ thousand_format($recap['value']) }}
                                    </span>
                        </div>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
    <br><br>

    <div class="flex" style="justify-content:space-between">
        <a href="{{ route('admin.order.input-order',$order->id) }}"
           class="text-green-900 bg-green-100 rounded px-4 py-2">Lakukan Perubahan</a>
        <button wire:click="confirmOrder" class="text-white bg-green-900 rounded px-4 py-2">Konfirmasi Transaksi
        </button>

    </div>


</div>
