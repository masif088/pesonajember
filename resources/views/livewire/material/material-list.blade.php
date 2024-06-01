<div>
    <div class="gap-5 lg:grid lg:grid-cols-10 bg-wishka-200 rounded-2xl p-5 divide-x-2 shadow-lg items-center justify-center">
        @foreach($categories as $index=>$category)
            <div class="col-span-2 text-left text-lg pl-5 ">
                <b>{{ $category->materials->count() }}</b> <br>
                {{ $category->title }}
            </div>
        @endforeach
    </div>
    <br>
    <div class="rounded-xl border shadow-lg p-8">

        <a href="{{ route('material.create') }}" class="btn bg-wishka-600">Tambah Material</a>
        <br><br>
        <livewire:table.master name="Material"/>
    </div>
</div>
