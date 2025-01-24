@php use Carbon\Carbon; @endphp
<div>
    <h3>Rekap Transaksi</h3>

    <div class="grid grid-cols-12">
        <div class="col-span-12 grid grid-cols-12 gap-3">
            <x-argon.show-data title="Nama Lengkap" content="{{ $user->name }}"/>
            <x-argon.show-data title="Alamat" content="{{ !is_null($user->address)?$user->address:'-' }}"/>

            <x-argon.show-data title="No. Telepon" content="{{ $user->phone }}"/>
            <x-argon.show-data title="Email" content="{{ $user->email }}"/>
        </div>
        <br>
        <div class="col-span-12">
            <div class="">
                Pesan
            </div>
            <div class="">
                @php
                    $content =\App\Models\GeneralInfo::where('key','=','penagihan_termin_1')->first()->value;
                    $content= str_replace('[CUSTOMER_NAME]',$user->name,$content);
                    $content= str_replace('[PAYMENT_MODEL_1]',$paymentModel[0],$content);
                    $content= str_replace('[TOTAL_TRANSACTION]','Rp. ' .thousand_format($transaction->total_money),$content);
                    $content= str_replace('[TOTAL]','Rp. '.thousand_format($paymentModel[0]*$transaction->total_money/100),$content);
                    $content= str_replace('[NO_INVOICE]',$transaction->uid,$content);
                    $content= str_replace('[DATE]',$transaction->created_at->format('d/m/Y'),$content);

                    $wac = str_replace(' ','%20',$content);
                    $wac = str_replace('<br>','%0a',$content);
                    $wac = preg_replace("/[\n\r]/","%0a", $content);

//                    $conte.replace(/(\r\n|\n|\r)/gm, '&#13;&#10;');
                @endphp
                <div style="  white-space: pre-wrap;"
                    class="max-w-full px-3 sm:w-full sm-max:w-full md:w-full sm-max:mt-1  sm:flex-none xl:mb-0  bg-gray-200 rounded py-2" >{{ $content }}</div>
                <br>
{{--                <script>--}}
{{--                    document.addEventListener("DOMContentLoaded", function () {--}}
{{--                        var boxText = `{{ $content }}`--}}
{{--                        boxText = boxText.replace(/<br\s?\/?>/g,"\n");--}}
{{--                        console.log(boxText)--}}
{{--                        document.getElementById('wa_button').href = `https://wa.me/{{ $this->waNumber }}?text=${boxText}`;--}}
{{--                        document.getElementById('wa_button').innerHTML="asdasd";--}}
{{--                    });--}}
{{--                </script>--}}
                <div class="flex gap-1">
                    <a target="_blank"
                       id="wa_button"
                       wire:click="sendMessage"
                       href="https://wa.me/{{ $this->waNumber }}?text={{ $wac }}"
                       class="btn bg-success">
                        Lakukan Penagihan Melalui WhatsApp
                    </a>

                    <a target="_blank"
                       id="wa_button"
                       wire:click="sendMessage"
                       href="{{ route('email.new-order',$transaction->id) }}"
                       class="btn bg-wishka-600">
                        Lakukan Penagihan Melalui Email
                    </a>
                </div>
            </div>



        </div>
    </div>



</div>
