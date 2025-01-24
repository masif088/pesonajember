@props(['title'=>'', 'href'=>'#', 'class'=>'bg-green-900 hover:bg-green-200 text-white'])
<a href="{{ $href }}" class="px-6 py-2 rounded flex-nowrap text-nowrap {{ $class }}" style="margin-top: 100px">
    {{ $title }}
</a>
