@php use Carbon\Carbon; @endphp
@php use App\Models\Order; @endphp
<div class="grid grid-cols-12 gap-3">
    @foreach(\App\Models\Wallet::get() as $wallet)
        <div class="col-span-4 md:col-span-4 sm:col-span-12">
            <div class="card">
                <div class="card-body bg-gray-50 rounded flex gap-3 align-middle p-3">
                    <div class="bg-green-200 rounded-full my-auto" style="width: 64px;height: 64px; padding: 20px 0">
                        <span class="iconify text-green-900 text-2xl mx-auto" data-icon="icon-park-solid:wallet"></span>
                    </div>
                    <div>
                        Saldo <br>
                        <h6>{{ $wallet->name }}</h6>
                        <h4 class="text-green-900 mb-2">
                            Rp. {{ thousand_format($wallet->walletDetails->sum('debit')-$wallet->walletDetails->sum('credit')) }}
                        </h4>
                        <a href="{{ route('admin.wallet.show',$wallet->id) }}"
                           class="bg-green-900 text-white px-2 py-1 rounded">Lihat Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
