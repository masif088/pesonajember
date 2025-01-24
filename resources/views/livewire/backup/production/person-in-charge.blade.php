<div class="card ">
    <div class="card-body ">
        <h2 class="text-2xl">Tugas saya</h2>
        <livewire:table.production name="ProductionPersonInCharge" param1="{{auth()->user()->id}}"/>
    </div>
</div>
