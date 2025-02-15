<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }} - {{ $data->company_name  }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/>
        <a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 grid grid-cols-12 gap-3">
            <div class="card col-span-8 shadow-none border">
                <div class="card-body">
                    <h5 class="card-title">
                        Data Konsumen
                        <a href="{{ route('admin.customer.edit',$data->id) }}" class="float-end bg-yellow-100 hover:bg-yellow-200 rounded text-white text-center p-1 " >
                            <span class='iconify text-yellow-900 text-xl' data-icon='ic:baseline-edit'></span>
                        </a>
                    </h5>
                    <br>
                    <table class="">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>:</td>
                            <td>{{ $data->company_name }}</td>
                        </tr>
                        <tr>
                            <td>No Hp</td>
                            <td>:</td>
                            <td>{{ $data->phone }}</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>:</td>
                            <td>{{ $data->note }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card col-span-4 shadow-none border">
                <div class="card-body">
                    <h5 class="card-title">
                        Akun Bank
                        <a href="{{ route('admin.customer.account.create',$data->id) }}" class="float-end bg-green-900 rounded-full text-white text-center" style="width: 28px">
                            <i class="ti ti-plus "></i>
                        </a>
                    </h5> <br>
                    @foreach ($data->customerAccounts as $account)
                    <div class='bg-blue-200 p-2 mb-1 text-xs'>
                        <div class='float-right flex middle px-2'>
                            <i class='ti ti-copy text-xl' onclick='navigator.clipboard.writeText(`{{$account->account_number}}`);alert(`Rekening berhasil di copy`)'></i>
                            <a href="{{ route('admin.customer.account.edit',[$data->id, $account->id]) }}">
                                <i class='ti ti-edit text-yellow-900 text-xl ml-2' data-icon='ic:baseline-edit'></i>
                            </a>
                        </div>
                        <div>
                            {{ $account->bank_name }}
                            <span class='font-bold'>{{$account->account_number}}</span>
                        </div>
                        <div>A/N<span class='font-bold'> {{$account->account_name}}</span></div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card col-span-6 shadow-none border">
                <div class="card-body">
                    <h5 class="card-title">Order List</h5>
                    <table class="table w-full" >
                        <tr>
                            <td>#</td>
                            <td>Nomer Transaksi</td>
                            <td>Tanggal Transaksi</td>
                            <td>Aksi</td>
                        </tr>
                        @foreach($data->orders->sortByDesc('created_at')->take(10) as $index=>$order)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td class="flex">
                                <a href='{{ route('admin.order.show',$order->id) }}' class='p-2 bg-blue-200 hover:bg-blue-100 text-white rounded-sm transition-[opacity,margin]'>
                                    <span class='iconify text-blue-700' data-icon='icon-park-solid:transaction-order'></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>


    </div>
</x-admin-layout>
