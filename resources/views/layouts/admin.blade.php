<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Store In') }}</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend2/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend2/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend2/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('backend2/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend2/css/custom.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('backend2/images/favicon.png')}}" />
    <!-- Toaster notification -->
    <link rel="stylesheet" href="{{asset('backend2/vendors/toastr/toastr.min.css')}}">
    <style>
      .form-control{
        border: 1px solid #ddd;
      }
      .sidebar .nav .nav-item.active > .nav-link{
        background-color: #e9e9e9;
      }
    </style>
    @livewireStyles
</head>
<body>
  <div class="container-scroller">
    @include('layouts.admin.navbar')
    <div class="container-fluid page-body-wrapper">
      @include('layouts.admin.sidebar')
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')
          </div>
        </div>
    </div>
  </div>
  <!-- jquery -->
  <script src="{{asset('backend2/vendors/jquery/jquery.min.js')}}"></script>
  <!-- plugins:js -->
  <script src="{{asset('backend2/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <script src="{{asset('backend2/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('backend2/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <!-- inject:js -->
  <script src="{{asset('backend2/js/off-canvas.js')}}"></script>
  <script src="{{asset('backend2/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('backend2/js/template.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('backend2/js/dashboard.js')}}"></script>
  <script src="{{asset('backend2/js/data-table.js')}}"></script>
  <script src="{{asset('backend2/js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('backend2/js/dataTables.bootstrap4.js')}}"></script>
  <!-- End custom js for this page-->
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
  @stack('script')
  @livewireScripts
</body>
</html>