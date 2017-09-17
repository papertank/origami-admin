<!DOCTYPE html>
<html lang="en">
<head>
    @section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @show

    <title>@yield('meta_title', app('config.name'))</title>

    @section('fonts')
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    @show

    @section('assets')
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    @show
</head>
<body id="app" class="page-auth">
    @section('notice')
    <div class="container">
        @include('notice::all')
    </div>
    @show

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/admin.js') }}"></script>
    @stack('scripts')

    @yield('base')
</body>
</html>
