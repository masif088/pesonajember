<div>
    <div class="gap-3 lg:grid lg:grid-cols-12 mt-10">
        <div class="col-span-12 lg:col-span-2 items-stretch">
            <span>
            Per Page: &nbsp;
            <select wire:model.live="perPage" id="perPage"
                    class="bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full px-4 py-2 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white"
                    style="" onchange="onChange()">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="-1">All</option>
            </select>
            </span>
        </div>
        <script>
            function onChange() {
                @this.set(`perPage`, $(`#perPage`).val());
            }
        </script>
        <div class="md:col-span-6"></div>
        @if($searchable)
            <div class="col-span-12 lg:col-span-4 items-stretch">
                <span class="w-full">
                    Pencarian
                    <input wire:model.live="search"
                           class="text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white"
                           type="text" placeholder="Pencarian...">
                </span>
            </div>
        @endif
        @if($dateSearch)
            <div class="flex items-center">
                <span class="w-full">
                    Tanggal
                    <input wire:model="param1"
                           class="text-dark bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark dark:text-light focus:dark:border-white"
                           type="date" placeholder="Pencarian...">
                </span>
            </div>
        @endif
        {{--        dateSearch--}}

    </div>
    <div class="grid grid-cols-1 gap-3 p-4 lg:grid-cols-1 xl:grid-cols-1">
        <div class="overflow-x-auto relative ">
            <table
                class="border-collapse border-wishka-400 w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded table-auto">
                <thead class=" text-md text-uppercase text-gray-700 uppercase dark:bg-dark dark:text-white text-bold">
                <tr class="border-b-[3px] border-wishka-400 border-collapse">
                    @foreach($model::tableField() as $field)
                        <th class="py-4 px-6" style="{{ isset($field['width'])?'width:'.$field['width']:'' }}
                        {{ isset($field['text-align'])?'text-align:'.$field['text-align']:'' }}
                        ">
                            <a @isset($field['sort']) wire:click.prevent="sortBy('{{ $field['sort'] }}')"
                               @endisset role="button" href="#">
                                {{$field['label']}} @isset($field['sort'])
                                    @include('components.argon.data-table-component.sort-icon', ['field' => $field['sort']])
                                @endif
                            </a>
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($datas as $index=>$data)
                    <tr class=" dark:text-white text-black border-b border-gray-200 align-text-top">
                        @foreach ($model::tableData($data,$params) as $data)
                            @switch($data['type'])
                                @case('index')
                                    <td class="py-4 px-6 font-extralight"
                                        style="{{ isset($data['text-align'])?'text-align:'.$data['text-align']:'' }}">{{ $index+1 + (request()->get('page')?request()->get('page')-1:0)*$perPage }}</td>
                                    @break
                                @case('string')
                                    <td class="py-2 px-6 @isset($data['font-size']) @if( $data['font-size']!='' ) {{ $data['font-size'] }} @endif @else font-extralight @endisset  @isset($data['color']) {{ $data['color'] }} @endisset"
                                        style="{{ isset($data['text-align'])?'text-align:'.$data['text-align']:'' }}">{{ $data['data'] }}</td>
                                    @break
                                @case('thousand_format')
                                    <td class="py-2 px-6 font-extralight"
                                        style="{{ isset($data['text-align'])?'text-align:'.$data['text-align']:'' }}">{{ thousand_format($data['data']) }}</td>
                                    @break
                                @case('raw_html')
                                    <td class="py-2 px-6 font-extralight "
                                        style="{{ isset($data['text-align'])?'text-align:'.$data['text-align']:'' }}
                                        {{ isset($data['vertical-align'])?'vertical-align:'.$data['vertical-align']:'' }}">{!! $data['data'] !!}</td>
                                    @break
                                @case('img')
                                    <td class="py-2 px-6"
                                        style="{{ isset($data['text-align'])?'text-align:'.$data['text-align']:'' }}">
                                        <img src="{{ $data['data'] }}" alt=""
                                             style="{{ isset($data['width'])?'width:'.$data['width'].';':'' }}
                                             {{ isset($data['height'])?'height:'.$data['height'].';':'' }}">
                                    </td>
                                    @break
                                @case('action')
                                    <td class="py-2 px-6"
                                        style="{{ isset($data['text-align'])?'text-align:'.$data['text-align']:'' }}">
                                        @foreach($data['data'] as $action)
                                            <a @isset($action['link']) href='{{ $action['link'] }}' @else href='#'
                                               wire:click.prevent='{{$action['live']}}' @endisset
                                               class="{{$action['bg']??''}} py-1 px-3 rounded m-1">
                                                @isset($action['icon'])
                                                    <i class="{{ $action['icon'] }}"></i>
                                                @endisset
                                                {{ $action['title'] }}
                                            </a>
                                        @endforeach
                                    </td>
                                    @break
                            @endswitch
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($perPage!=-1)
            <div id="table_pagination" class="py-3">
                {{ $datas->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        @endif
        @if($extras)
            <div>
                {!! $model::extras($datas) !!}
            </div>
        @endif
    </div>
</div>

