<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">

    <!-- Toaster notification -->
    <link rel="stylesheet" href="{{asset('backend2/vendors/toastr/toastr.min.css')}}">

    @livewireStyles
</head>
<body>
    <div id="app">
        @include('layouts.frontend.navbar')

        <main class="py-1">
            @yield('content')
        </main>
    </div>
    
    <!-- Scripts -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Toaster  & Sweetalert -->
    <script src="{{asset('backend2/vendors/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('backend2/vendors/sweetalert/sweetalert.min.js')}}"></script>

    <script>
        $(document).ready(function(){
        toastr.options = {
            'positionClass' : 'toast-top-right'
        };
        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail.message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });
        window.addEventListener('info', event => {
            toastr.info(event.detail.message);
        });
        });

    </script>

    @livewireScripts
</body>
</html>
