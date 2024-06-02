<x-admin-layout>
    <x-slot name="title">
        Stock Material
    </x-slot>
    <div class="">
        <br>
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12">
                <div>
                    <div class="rounded-xl border shadow-lg p-5">
                        <h2 class="text-2xl text-wishka-400">
                            STOCK MATERIAL
                        </h2>
                        <br><br>
                        <a href="{{ route('material.material-stock-mutation',$id) }}" class="btn bg-wishka-600">Mutasi Material</a>

                        <br><br>

                        <livewire:material.material-data :data-id="$id"/>
                        <br>
                        <livewire:table.master name="MaterialMutation"/>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
