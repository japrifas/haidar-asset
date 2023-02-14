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
    <link rel="shortcut icon" href="{{ asset('back/static/haidar.ico') }}" type="image/x-icon">
    <!-- CSS files -->
    {{-- <base href="/"> --}}
    <link href="{{ asset('back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/libs/toastr/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/libs/ijabocrop/ijabocrop.min.css') }}" rel="stylesheet" />
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('stylesheets') @livewireStyles
    <link href="{{ asset('back/dist/css/demo.min.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        @include('back.layouts.inc.sidebar')
        @include('back.layouts.inc.header')
        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <!-- Page title -->
                    @yield('pageHeader')
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
            @include('back.layouts.inc.footer')
        </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('back/dist/libs/jquery/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/ijabocrop/ijabocrop.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('back/dist/js/tabler.min.js') }}"></script>
    @stack('scripts')
    @livewireScripts
    <script>
        window.addEventListener('showToastr', function(event) {
            toastr.remove();
            if (event.detail.type === 'info') {
                toastr.info(event.detail.message);
            } else if (event.detail.type === 'success') {
                toastr.success(event.detail.message);
            } else if (event.detail.type === 'error') {
                toastr.error(event.detail.message);
            } else if (event.detail.type === 'warning') {
                toastr.warning(event.detail.message);
            } else {
                return false;
            }
        });
    </script>
    <script src="{{ asset('back/dist/js/demo.min.js') }}"></script>
</body>

</html>
