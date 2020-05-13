<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIM - Perpustakaan</title>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/fontawesome-free/css/all.min.css')) }}">
    @yield('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset(('dist/css/adminlte.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')) }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset(('plugins/summernote/summernote-bs4.css')) }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset(('bootstrap/css/bootstrap.min.css')) }}">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->


</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @include('partials.navbar')
    @include('partials.sidebar.main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('page-heading')</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
                @yield('content')
    </div>

    <!-- BEGIN: Footer-->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 AdminLTE.io</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.0.4
        </div>
    </footer>
<!-- END: Footer-->

<!-- BEGIN: Vendor JS-->
    <script src="{{ asset(('plugins/jquery/jquery.min.js')) }}"></script>
    <script src="{{ asset(('plugins/jquery-ui/jquery-ui.min.js')) }}"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset(('plugins/bootstrap/js/bootstrap.bundle.min.js')) }}"></script>
    <script src="{{ asset(('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')) }}"></script>
    <script src="{{ asset(('dist/js/adminlte.min.js')) }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <!-- END: Theme JS-->
    @yield('scripts')
</body>
</html>
