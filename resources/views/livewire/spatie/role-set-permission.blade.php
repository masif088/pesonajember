<form wire:submit="create" class="lg:grid grid-cols-12 gap-3">
    <div class="lg:grid grid-cols-12 gap-3 col-span-12">
        <div class="col-span-12">
            <div class="mb-2" style="align-items: center;">
                Role
            </div>

            <select wire:model="role"
                    class="mb-2 bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white"
                    name="">
                <option value=""></option>
                @foreach( $optionRole as $option)
                    <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12">
            <div class="mb-2 flex" style="align-items: center;">
                Izin :
            </div>
            <div wire:ignore>
                <select id="product" wire:model="permission"
                        style="width: 100%"
                        class="mb-2 bg-gray-200 appearance-none border-1 border border-gray-100 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:border-primary-light focus:bg-gray-100 dark:bg-dark focus:dark:border-white select2 select3"
                        multiple=""
                        name=""
                        onchange="permission()"
                >
                    @foreach( $optionPermission as $option)
                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('.select3').select2();
            });
            function permission() {
                @this.set(`permission`, $(`#product`).val());
            }
        </script>
        <div class="col-span-9"></div>
        <button class="btn bg-wishka-600 col-span-3 float-right mt-4">Submit</button>
    </div>
</form>
