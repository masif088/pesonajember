<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="Blue_Theme" class="light selected"
      data-layout="vertical" data-boxed-layout="boxed" data-card="shadow">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700&amp;display=swap"/>
    <link rel="stylesheet" href="{{asset('assets/icons-webfont/tabler-icons.min.css')}}">

    <!-- Core Css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--        <link rel="stylesheet" href="{{ asset('build/assets/app-DhRByuLa.css') }}">--}}
{{--        <script src="{{ asset('build/assets/app-D2jpX1vH.js') }}"></script>--}}
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css?2') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/carousel/carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.css') }}">
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
    <style>
        .autocomplete {
            width: 100%;
            position: relative;
            display: inline-block;
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
                            <div>
                                <h1 class="text-3xl uppercase">{{ $title }}</h1>
                            </div>
                        @endisset

                        @isset($breadcrumb)
                            <div>
                                <h1 class="text-2xl">{{ $title }}</h1>
                            </div>
                        @endisset

                        {{ $slot }}
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

<script>
    function handleColorTheme(e) {
        document.documentElement.setAttribute("data-color-theme", e);
    }
</script>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
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

@stack('custom-script')
@livewireScripts
</body>

</html>

