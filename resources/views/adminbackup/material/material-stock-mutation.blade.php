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
                            PERUBAHAN STOCK MATERIAL
                        </h2>
                        <br><br>
                        <livewire:material.material-data :data-id="$id"/>
                        <br>
                        <div class="col-span-12  mb-2 bg-wishka-700 dark:bg-wishka-200 h-[4px]"></div>
                        <br>
                        <div class="col-span-12">
                            <livewire:material.material-mutation :data-id="$id"/>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
</x-admin-layout>
