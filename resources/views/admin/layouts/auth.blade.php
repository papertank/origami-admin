<!DOCTYPE html>
<html lang="en">
<head>
    @section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @show
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', config('app.name'))</title>

    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    @stack('assets-head')

</head>
<body id="app" class="page-auth">

    @yield('content')

    <script src="{{ asset('assets/js/admin.js') }}"></script>
    @stack('assets-base')

    @yield('base')
</body>
</html>
