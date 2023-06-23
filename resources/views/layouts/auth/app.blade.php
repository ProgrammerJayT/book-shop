<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Book-Shop') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend2/vendors/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('backend2/vendors/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend2/css/adminlte.min.css')}}">
    <!-- Toaster notification -->
    <link rel="stylesheet" href="{{asset('backend2/vendors/toastr/toastr.min.css')}}">
</head>

@yield('content')

    <!-- jQuery -->
    <script src="{{asset('backend2/vendors/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('backend2/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend2/js/adminlte.min.js')}}"></script>

    <!-- Toaster  & Sweetalert -->
    <script src="{{asset('backend2/vendors/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('backend2/vendors/sweetalert/sweetalert.min.js')}}"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{Session::get('alert-type','info')}}";
            switch (type) {
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('message')}}");
            break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
            break;
            case 'error':
                toastr.error("{{Session::get('message')}}");
            break;      
            }
        @endif
    </script>
</body>
</html>