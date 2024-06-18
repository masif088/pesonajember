@php use Carbon\Carbon; @endphp
<div>
    @if(Carbon::now()->format('H:i') < "10:00" and $statusEntrance==0)
        <a href="#" wire:click="entrance()" class="btn bg-wishka-400">Klik disini untuk presensi masuk</a>
    @endif
    @if(Carbon::now()->format('H:i') < "16:00" and $statusEntrance==1)
        <div class="bg-secondary p-4 py-2 rounded-md text-white w-fit">Anda telah melakukan presensi
            pada {{ Carbon::parse(($check->entrance_attendance_by_web))->format('H:i') }}</div>
    @endif

    @if(Carbon::now()->format('H:i') > "10:00" and $statusEntrance==0)
        <div class="bg-error p-4 py-2 rounded-md text-white w-fit">
            Anda telah melewatkan waktu presensi :'D
        </div>
    @endif

    @if(Carbon::now()->format('H:i') > "16:00" and $statusDischarge==1)
        <a href="#" wire:click="discharge()" class="btn bg-wishka-400">Klik disini untuk presensi pulang</a>
    @endif
    @if(Carbon::now()->format('H:i') > "16:00" and $statusDischarge==0)
        <div class="bg-secondary p-4 py-2 rounded-md text-white w-fit">Anda telah melakukan presensi pulang
            pada {{ Carbon::parse(($check->entrance_attendance_by_web))->format('H:i') }}</div>
    @endif

</div>
