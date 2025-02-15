<x-admin-layout>
    <x-slot name="title">
        {{ $property['title'] }} - {{ $data->name }}
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ $property['index'] }}">{{ $property['main-title'] }}</a>
        <x-breadcrumbs-slash/>
        <a href="#" class="font-bold">{{ $property['title'] }}</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-6 grid grid-cols-12 gap-3">
            <div class="card col-span-12 border">
                <div class="card-body">
                    <h5 class="card-title">Data Supplier</h5>
                    <br>
                    <table class="">
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $data->address }}</td>
                        </tr>
                        <tr>
                            <td>PIC</td>
                            <td>:</td>
                            <td>{{ $data->pic }}</td>
                        </tr>
                        <tr>
                            <td>No Hp</td>
                            <td>:</td>
                            <td>{{ $data->phone??' - ' }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $data->email??' - ' }}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{ $data->status?'Aktif':'Tidak aktif' }}</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>:</td>
                            <td>{{ $data->note }}</td>
                        </tr>
                        <tr>
                            <td>Supplier ditambahkan pada</td>
                            <td>:</td>
                            <td>{{ $data->created_at->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Terakhir diperbarui pada</td>
                            <td>:</td>
                            <td>{{ $data->updated_at->format('d/m/Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card col-span-12 border">
                <div class="card-body">
                    <h5 class="card-title">Daftar transaksi</h5>
                </div>
            </div>
        </div>
        <div class="col-span-6 grid grid-cols-12 gap-3">
            <livewire:supplier.transaction-chart :data-id="$data->id"/>
        </div>
    </div>
</x-admin-layout>
