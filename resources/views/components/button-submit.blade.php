@props(['title'=>'', 'class'=>'','styles'=>'bg-green-900 hover:bg-green-200  text-white'])
<button type="submit" class="{{ $styles }} px-6 py-2 rounded flex-nowrap text-nowrap {{ $class }}">
    {{ $title }}
</button>
