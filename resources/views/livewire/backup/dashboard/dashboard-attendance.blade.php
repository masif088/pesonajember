
<div class="card ">
    <div class="card-body ">
        <h2 class="text-2xl">Rekap Absensi</h2>
        <livewire:table.master name="UserAttendance" param1="{{auth()->user()->id}}"/>
    </div>
</div>
