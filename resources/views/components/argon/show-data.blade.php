@props(['title'=>'','content'=>''])

<div class="grid grid-cols-12 col-span-6">
    <div class="col-span-6 py-2">
        {!! $title !!}
    </div>
    <div class="col-span-6 bg-gray-200 rounded py-2 px-3">
        {!! $content !!}
    </div>
</div>
