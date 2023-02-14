<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta5
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    {{-- <base href="/"> --}}
    <link href="{{ asset('back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    @stack('stylesheets')
    @livewireStyles
    <link href="{{ asset('back/dist/css/demo.min.css') }}" rel="stylesheet" />
</head>

<body class=" border-top-wide border-primary d-flex flex-column">
    @yield('content')
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('back/dist/libs/jquery/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('back/dist/js/tabler.min.js') }}"></script>
    @stack('scripts')
    @livewireScripts
    <script src="{{ asset('back/dist/js/demo.min.js') }}"></script>
    <script>
        $('.icon-password').click(function() {
            if ($(this).hasClass("show")) {
                $('.icon-tabler-eye-off').addClass("d-none");
                $('.icon-tabler-eye').removeClass("d-none");
                $(this).removeClass("show");
                $('.input-password').attr('type','password');

            } else {
                $('.icon-tabler-eye-off').removeClass("d-none");
                $('.icon-tabler-eye').addClass("d-none");
                $(this).addClass("show");
                $('.input-password').attr('type','text');
            }

        });
    </script>
</body>

</html>
