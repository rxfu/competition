<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="{{ config('setting.keywords') }}">
    <meta name="description" content="{{ config('setting.description') }}">
    <meta name="author" content="{{ config('setting.author') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default') | {{ config('setting.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- Font Awesome Icons -->
    <link href="{{ asset('vendor/font-awesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/brands.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/regular.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/solid.min.css') }}" rel="stylesheet">
    <!---Bootstrap 4 -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    @stack('styles')
</head>
<body class="hold-transition @yield('body-class')">

    @yield('page')
    
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Custom scripts -->
    @stack('scripts')
</body>
</html>
