@php use App\Models\User;use Spatie\Permission\Models\Role; @endphp
<x-admin-layout>
    <x-slot name="title">
        List akses
    </x-slot>
    <div class="">

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <br><br>


                {{--                <br><br>--}}
                {{--                <livewire:table.master name="Bank"/>--}}
                <a href="{{ route('spatie.role-set-permission') }}" class="btn bg-wishka-600">Tambah Set role ke
                    izin</a><br><br>
                <br><br>
                <a href="{{ route('spatie.role-create') }}" class="btn bg-wishka-600">Tambah Akses</a><br><br>
                <div class="lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">
                    <h2 class="text-xl font-bold text-wishka-600 mb-2">Nama Akses/role</h2>
                    <table class="invoice-table w-full">
                        <thead>

                        <tr class="bg-wishka-600 text-white">
                            <td class="text-center" style="padding: 5px">#</td>
                            <td>Nama Role</td>
                            <td>Karyawan</td>
                            <td>Izin</td>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach(Role::all() as $index=>$role)
                            <tr class=" {{ $index%2==0?'bg-gray-100':'' }} py-2">
                                <td class="text-center">{{ $index+1 }}</td>
                                <td>{{ $role['name'] }}</td>
                                <td>
                                    @foreach(User::with('roles')->whereHas('roles',function ($q) use ($role){$q->where('name',$role['name']);})->get() as $user)
                                        {{ $user->name }}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach(Role::findByName($role['name'])->getPermissionNames() as $p)
                                        {{$p}} <br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <br><br>
                <a href="{{ route('spatie.permission-create') }}" class="btn bg-wishka-600">Tambah Izin</a><br><br>
                <div class="lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">
                    <h2 class="text-xl font-bold text-wishka-600 mb-2">Nama izin</h2>
                    <table class="invoice-table w-full">
                        <thead>

                        <tr class="bg-wishka-600 text-center text-white">
                            <td style="padding: 5px">#</td>
                            <td>Nama Izin</td>
                            <td>Karyawan</td>
                            <td>Izin</td>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach(\Spatie\Permission\Models\Permission::all() as $index=>$role)
                            <tr class="">
                                <td class="text-center">{{ $index+1 }}</td>
                                <td>{{ $role['name'] }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
