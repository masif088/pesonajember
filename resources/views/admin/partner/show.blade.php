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
            <div class="card col-span-12 shadow-none border">
                <div class="card-body">
                    <h5 class="card-title">Data Partner/CV</h5>
                    <br>
                    <table class="font-light">
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $data->address }}</td>
                        </tr>
                        <tr>
                            <td>No Hp</td>
                            <td>:</td>
                            <td>{{ $data->address }}</td>
                        </tr>
                        <tr>
                            <td>Yang bertanda tangan di dokumen</td>
                            <td>:</td>
                            <td>{{ $data->sign_name }}</td>
                        </tr>
                        <tr>
                            <td>Posisi yang bertanda tangan di dokumen</td>
                            <td>:</td>
                            <td>{{ $data->sign_position }}</td>
                        </tr>
                        <tr>
                            <td>Format nomer invoice</td>
                            <td>:</td>
                            <td>{{ $data->format_number_invoice }}</td>
                        </tr>
                        <tr>
                            <td>Format nomer surat jalan</td>
                            <td>:</td>
                            <td>{{ $data->format_number_driver }}</td>
                        </tr>
                        <tr>
                            <td>Format nomer kwitansi</td>
                            <td>:</td>
                            <td>{{ $data->format_number_proof_of_cash }}</td>
                        </tr>
                        <tr>
                            <td>Format nomer barang keluar</td>
                            <td>:</td>
                            <td>{{ $data->format_number_outcome }}</td>
                        </tr>
                        <tr>
                            <td>Format nomer barang masuk</td>
                            <td>:</td>
                            <td>{{ $data->format_number_income }}</td>
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
                    </table>
                </div>
            </div>
            <div class="card col-span-12 shadow-none border">
                <div class="card-body">
                    <h5 class="card-title">Data Akun Bank Partner/CV</h5>

                </div>
            </div>
        </div>
        <div class="col-span-6 grid grid-cols-12 gap-3">
            <div class="card col-span-12 shadow-none border">
                <div class="card-body">
                    <h5 class="card-title">Kop Surat Partner/CV</h5>
                    <br>
                    <img src="{{ asset('storage/'.$data->kop) }}" alt="Kop surat masih belum di upload" class="w-full">
                </div>
            </div>
            <div class="card col-span-12 shadow-none border">
                <div class="card-body">
                    <h5 class="card-title">Logo Partner/CV</h5>
                    <br>
                    <img src="{{ asset('storage/'.$data->logo) }}" alt="Logo masih belum di upload" class="w-full">
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
