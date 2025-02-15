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
            <div class="card col-span-8  border">
                <div class="card-body">
                    <h5 class="card-title">Data Konsumen</h5>
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
            <div class="card col-span-4  border">
                <div class="card-body">
                    <h5 class="card-title">Data Akun Bank Konsumen</h5>

                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
