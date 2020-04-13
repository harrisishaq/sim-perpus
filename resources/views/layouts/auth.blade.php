<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Page</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    {!! HTML::style('app-assets/vendors/css/vendors.min.css') !!}
    {!! HTML::style('app-assets/css/bootstrap.css') !!}
    {!! HTML::style('app-assets/css/bootstrap-extended.css') !!}
    {!! HTML::style('app-assets/css/colors.css') !!}
    {!! HTML::style('app-assets/css/components.css') !!}
    {!! HTML::style('app-assets/css/themes/dark-layout.css') !!}
    {!! HTML::style('app-assets/css/themes/semi-dark-layout.css') !!}
    {!! HTML::style('app-assets/css/core/menu/menu-types/vertical-menu.css') !!}
    {!! HTML::style('app-assets/css/core/colors/palette-gradient.css') !!}
    {!! HTML::style('app-assets/css/pages/authentication.css') !!}

    @yield('header-scripts')
</head>
<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <div class="app-content content">
        @yield('content')
    </div>

    {!! HTML::script('login-assets/js/vendor.js') !!}
    {!! HTML::script('login-assets/js/as/app.js') !!}
    {!! HTML::script('login-assets/js/as/btn.js') !!}
    @yield('scripts')
    @hook('auth:scripts') 
</body>
</html>
