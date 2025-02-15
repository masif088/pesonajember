<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="Blue_Theme" class="light selected"
      data-layout="vertical" data-boxed-layout="boxed" data-card="shadow">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}?v=2"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700&amp;display=swap"/>
    <link rel="stylesheet" href="{{asset('assets/icons-webfont/tabler-icons.min.css')}}">

    <!-- Core Css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

    <link rel="stylesheet" href="{{ asset('vendor/carousel/carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@iconify/iconify@3.1.1/dist/iconify.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/cdy7uy0kp3sps4cksg5twt8j1dbz75v48yog5k9ype8x9oo3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


    <style>
        .autocomplete {
            width: 100%;
            position: relative;
            display: inline-block;
        }
        .swal2-title{
            line-height: 25px;
            font-size: 18px;
        }


        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>

    @livewireStyles
</head>
<body class="DEFAULT_THEME bg-white dark:bg-dark">

<main>
    <!--start the project-->
    <div id="main-wrapper" class="flex">
        <!-- Vertical Sidebar Menu -->
        @include('layouts.admin-component.sidebar-vertical')
        <!-- Vertical Sidebar Menu end -->
        <div class="page-wrapper w-full" role="main">
            <!--  Header Start -->
            @include('layouts.admin-component.header')
            <!--  Header End -->

            <!-- Horizontal Header Menu -->
            @include('layouts.admin-component.sidebar-horizontal')
            <!-- Horizontal Header Menu End -->

            <!-- Main Content -->
            <div class=" max-w-full pt-6">
                <div class="container full-container">
                    <div class="mb-5 lg:p-5">
                        @isset($title)
                            <div class="grid grid-cols-12">
                                <div class="text-md  col-span-12 text-green-900 mb-5">
                                    @isset($breadcrumb)
                                        <a href="{{ route('admin.dashboard') }}">Home</a> <x-breadcrumbs-slash/>
                                        {{ $breadcrumb }}
                                    @endisset
                                </div>
                                <h1 class="text-3xl uppercase col-span-12">{{ $title }}</h1>
                            </div>
                        @endisset
                        <div class="mt-5">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Content End -->
        </div>
    </div>
    <!--end of project-->

</main>
@include('layouts.admin-component.toast')
<!-- Menu Canvas-->
@include('layouts.admin-component.navbar-md')

<!------- Customizer button--------->
<button type="submit" style="background: #1E3241"
        class="btn btn-primary overflow-hidden sm:h-14 sm:w-14 h-10 w-10 rounded-full fixed sm:bottom-8 bottom-5 right-8 flex justify-center items-center rtl:left-8 rtl:right-auto z-10"
        data-hs-overlay="#hs-overlay-right"
        >
    <i class="ti ti-settings sm:text-2xl text-lg text-white"></i>
</button>
<!------- Customizer Options--------->
@include('layouts.admin-component.settings')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/gh/fcmam5/nightly.js@v1.0/dist/nightly.min.js"></script>

<script>
    function handleColorTheme(e) {
        document.documentElement.setAttribute("data-color-theme", e);
    }
</script>

<script>

    const SwalModal = (icon, title, html) => {
        Swal.fire({
            icon,
            title,
            html
        })
    }

    const SwalConfirm = (icon, title, html, confirmButtonText, method, params, callback) => {
        Swal.fire({
            icon,
            title,
            html,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText,
            reverseButtons: true,
        }).then(result => {
            if (result.value) {
                // $wire.dispatch('post-created', { refreshPosts: true });
                return Livewire.dispatch(method, params)
            }

            if (callback) {
                return Livewire.dispatch(callback)
            }
        })
    }

    const SwalAlert = (icon, title, timeout = 2000) => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: timeout,
            onOpen: toast => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon,
            title
        })
    }


    document.querySelectorAll("#dark-layout").forEach((element) => {
        element.addEventListener("click", () => {
                var ss = document.createElement('link');
                ss.rel = "stylesheet";
                ss.href = "//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css";
                ss.id="dark-alert"
                document.head.appendChild(ss);
                document.getElementById("light-alert").remove();

            }
        );
    });

    document.querySelectorAll("#light-layout").forEach((element) => {
        element.addEventListener("click", () => {
                document.getElementById("dark-alert").remove();
            }
        );
    });

    document.addEventListener('DOMContentLoaded', () => {
        var ss = document.createElement('link');
        ss.rel = "stylesheet";
        if (localStorage.getItem("Theme")=="dark") {
            ss.id="dark-alert"
            ss.href = "//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css";
        } else {
            ss.id="light-alert"
        }
        document.head.appendChild(ss);

        window.addEventListener('redirect', function (d){
            const data = d.__livewire.params.data;
            setTimeout(function(){
                window.location.href = data.link;
            }, data.timeout);
        })


        window.addEventListener('swal:modal', function (d){
            const data = d.__livewire.params.data;
            SwalModal(data.icon, data.title, data.text)
        })

        window.addEventListener('swal:confirm', function (d) {
            const data = d.__livewire.params.data;
            SwalConfirm(data.icon, data.title, data.text, data.confirmText, data.method, data.params, data.callback)
        })

        window.addEventListener('swal:alert', function (d) {
            console.log(d)
            const data = d.__livewire.params.data;
            SwalAlert(data.icon, data.title, data.timeout)
        })
    })

</script>


<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('vendor/select2/js/select2.full.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
<script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/preline.js') }}"></script>
<script src="{{ asset('assets/libs/@preline/input-number/index.js') }}"></script>
<script src="{{ asset('assets/libs/@preline/tooltip/index.js') }}"></script>
<script src="{{ asset('assets/libs/@preline/stepper/index.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/components/hs-accordion/hs-accordion.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/components/hs-collapse/hs-collapse.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/components/hs-dropdown/hs-dropdown.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/components/hs-overlay/hs-overlay.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/components/hs-remove-element/hs-remove-element.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/components/hs-scrollspy/hs-scrollspy.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/components/hs-tabs/hs-tabs.js') }}"></script>
<script src="{{ asset('assets/libs/preline/dist/components/hs-tooltip/hs-tooltip.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/iconify@1.4.0/src/browser/index.min.js"></script>

@stack('custom-script')
@livewireScripts
</body>

</html>

