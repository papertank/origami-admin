<!DOCTYPE html>
<html lang="en">
<head>
    @section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @show

    <title>@yield('meta_title', config('app.name'))</title>

    @section('fonts')
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    @show

    @section('assets')
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    @show
</head>
<body id="app" class="@yield('body_class')">

    <div id="wrapper">

        @include('admin.partials.header')

        <div id="page-wrapper">
            @section('notice')
            <div class="container">
                @include('notice::all')
            </div>
            @show

            @yield('content')
        </div>

        @section('footer')
             @include('admin.partials.footer')
        @show

    </div>

    <script src="{{ asset('assets/js/admin.js') }}"></script>
    @stack('scripts')

    @yield('base')
</body>
</html>
