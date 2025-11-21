<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'School Application') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
    <!-- Favicon icon -->
    <link href="{{ asset('vendor/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/chartist/css/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/themify-icons/css/themify-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <main id="main-wrapper">
        <div class="nav-header">
            <a href="{{ url('/') }}" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('images/logo.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('images/logo-text.png') }}" alt="">
            </a>


        </div>

        @include('layouts.aside')
        @include('elements.toaster')

        <div class="content-body">
            <div class="container">

                @include('layouts.navigation')
                {{ $slot }}

            </div>
        </div>

        <div class="footer bg-transparent">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">soscom technologies</a>
                    2024</p>
            </div>
        </div>



    </main>

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard-2.js') }}"></script>

    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/jquery.validate-init.js') }}"></script>

    {{-- Toaster --}}
    <script src="{{ asset('vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/toastr-init.js') }}"></script>

    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/select2-init.js') }}"></script>
    <script src="{{ asset('js/plugins-init/pickadate-init.js') }}"></script>



</body>

</html>
