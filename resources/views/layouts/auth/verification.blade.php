<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Store In') }}</title>
    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/css/bootv4.1/bootstrap.min.css') !!}" rel="stylesheet">
    <!-- Toaster notification -->
    <link rel="stylesheet" href="{{asset('backend2/vendors/toastr/toastr.min.css')}}">
    
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
  
        body{
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #e9ecef;
        }
        .navbar-laravel
        {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .nav-link {
            font-weight: 700 !important;
        }
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
  
        </div>
    </div>
</nav>
  
@yield('content')

    <!-- Toaster  & Sweetalert -->
    <script src="{{asset('backend/vendors/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('backend/vendors/sweetalert/sweetalert.min.js')}}"></script>
    
    <script>
        @if (Session::has('status'))
            var type = "{{Session::get('alert-type','info')}}";
            switch (type) {
            case 'info':
                toastr.info("{{Session::get('status')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('status')}}");
            break;
            case 'warning':
                toastr.warning("{{Session::get('status')}}");
            break;
            case 'error':
                toastr.error("{{Session::get('status')}}");
            break;      
            }
        @endif
    </script>
</body>
</html>