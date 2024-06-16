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
    {{--        <link rel="stylesheet" href="{{ asset('build/assets/app-BNv0_hJj.css') }}">--}}
    {{--        <script src="{{ asset('build/assets/app-D2jpX1vH.js') }}"></script>--}}
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
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

<main class="container pt-5">
    <div class="mb-10">
        <img src="{{ asset('assets/images/logos/light-logo.png') }}" alt="" width="200">
    </div>
    {{ $slot }}
</main>

@stack('custom-script')
@livewireScripts
</body>

</html>

