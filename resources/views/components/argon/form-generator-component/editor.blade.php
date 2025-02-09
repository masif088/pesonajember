@props(['repository'])
<div class="mt-3 @isset($repository['class']) {{ $repository['class'] }} @endisset" wire:ignore>
    @isset($repository['title'])
        <label class="block text-sm text-black dark:text-white mb-1" for="data{{ $repository['model'] }}">
            {{ $repository['title'] }}

            @isset($repository['required']) @if($repository['required']) <font class="text-green-900">*(Wajib Diisi)</font> @endif @endisset
        </label>
    @endisset
  <textarea name="{{ $repository['model'] }}" wire:model="{{'form.'.$repository['model']}}" id="data{{ $repository['model'] }}" @isset($repository['disabled']) disabled @endisset></textarea>
    <script>
        document.addEventListener('livewire:init', () => {
            const useDarkMode = window.localStorage.getItem('dark') === "true";
            const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
            // tinymce.init({
            //     selector: 'textarea',
            //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            // });
            tinymce.init({
                selector: 'textarea#data{{ $repository['model'] }}',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                // toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',

                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                    editor.on('change', function (e) {
                        @this.
                        set('form.{{$repository['model']}}', editor.getContent());
                    });
                },


                skin: useDarkMode  ? "oxide-dark" : "snow",
                content_css: useDarkMode  ? "dark" : "default",
                {{--skin: useDarkMode ? 'oxide-dark' : 'oxide',--}}
                {{--content_css: useDarkMode ? '{{ asset('vendor/tinymce/dark.css') }}' : '{{ asset('vendor/tinymce/light.css') }}',--}}
            });
            $("#data{{ $repository['model'] }}").val(@this.get('form.{{ $repository['model'] }}'))
            $(".tox-tinymce").last().addClass("dark:border-primary")
        });
    </script>
</div>
