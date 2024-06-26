@php use App\Models\GeneralInfo;use Carbon\Carbon; @endphp
<div class="grid gap-5">
    @if(Carbon::now()->format('H:i') < "10:00" and $statusEntrance==0)
        @if(request()->ip()!= GeneralInfo::where('key','ip_wifi_kantor')->first()->value)
            <div>
                <a href="#" class="bg-error px-4 py-2 rounded-md text-white w-fit text-nowrap">
                    Anda tidak bisa melakukan presensi tanpa wifi wishka :'D
                </a>
            </div>
        @else
            <div>
                <a href="#" wire:click="entrance()" class="px-4 py-2 bg-wishka-400 text-nowrap text-white rounded-md">
                    Klik disini untuk presensi masuk
                </a>
            </div>
        @endif
    @endif

    @if(Carbon::now()->format('H:i') < "16:00" and $statusEntrance==1 and $check->entrance_attendance_by_web!=null)
        <div>
            <a class="bg-secondary px-4 py-2 rounded-md text-white w-fit text-nowrap" href="#">
                Anda telah melakukan presensi pada
                {{ Carbon::parse(($check->entrance_attendance_by_web))->format('H:i') }}
            </a>

        </div>
    @endif

    @if(Carbon::now()->format('H:i') > "10:00" and $statusEntrance==0)
        <div>
            <a href="#" class="bg-error px-4 py-2 rounded-md text-white w-fit text-nowrap">
                Anda telah melewatkan waktu presensi :'D
            </a>
        </div>
    @endif
    @if(Carbon::now()->format('H:i') > "16:00" and $statusDischarge==0)
        <div>
            <a href="#" wire:click="discharge()" class="px-4 py-2 bg-wishka-400 text-white text-nowrap rounded-md">
                Klik disini untuk presensi pulang
            </a>
        </div>
    @endif
    @if(Carbon::now()->format('H:i') > "16:00" and $statusDischarge==1 and $check->discharge_attendance_by_web!=null)
        <div>
            <a href="#" class="bg-secondary p-4 py-2 rounded-md text-white w-fit text-nowrap">
                Anda telah melakukan presensi pulang pada
                {{ Carbon::parse($check->discharge_attendance_by_web)->format('H:i') }}
            </a>
        </div>
    @endif

</div>
