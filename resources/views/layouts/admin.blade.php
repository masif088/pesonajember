<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="Blue_Theme" class="light selected"
      data-layout="vertical" data-boxed-layout="boxed" data-card="shadow">

<!-- Mirrored from bootstrapdemos.adminmart.com/modernize-tailwind-pro/dist/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Apr 2024 19:06:36 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Favicon icon-->
    {{--    <link rel="shortcut icon" type="image/png"--}}
    {{--          href="https://bootstrapdemos.adminmart.com/modernize-tailwind-pro/dist/assets/images/logos/favicon.png"/>--}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap"
          rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('assets/fonts/icons/tabler-icons/tabler-icons.css')}}">
    <!-- Core Css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    {{--    <link rel="stylesheet"--}}
    {{--          href="https://bootstrapdemos.adminmart.com/modernize-tailwind-pro/dist/assets/css/theme.css"/>--}}
    <title>Modernize TailwindCSS HTML Admin Template</title>
    <link rel="stylesheet"
          href="{{ asset('vendor/carousel/carousel.min.css') }}">
</head>

<body class="DEFAULT_THEME bg-white dark:bg-dark">

<main>
    <!--start the project-->
    <div id="main-wrapper" class="flex">


        @include('layouts.admin-component.sidebar-vertical')


        <!-- </aside> -->


        <div class="page-wrapper w-full" role="main">
            <!--  Header Start -->
            @include('layouts.admin-component.header')
            <!--  Header End -->

            <!-- Horizontal Header Menu -->
            @include('layouts.admin-component.sidebar-horizontal')
            <!-- Horizontal Header Menu End -->

            <!-- Main Content -->
            <div class=" max-w-full pt-6">
                <div class="container full-container py-5">
                    <div class="grid grid-cols-12 gap-6">
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
<button type="button"
        class="btn overflow-hidden  sm:h-14 sm:w-14 h-10 w-10 rounded-full fixed sm:bottom-8 bottom-5 right-8 flex justify-center items-center rtl:left-8 rtl:right-auto z-10"
        data-hs-overlay="#hs-overlay-right">
    <i class="ti ti-settings sm:text-2xl text-lg text-white"></i>
</button>

<!------- Customizer Options--------->
@include('layouts.admin-component.settings')

<script>
    function handleColorTheme(e) {
        document.documentElement.setAttribute("data-color-theme", e);
    }
</script>


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
</body>


</html>

