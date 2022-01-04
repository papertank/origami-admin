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

    @adminStyles
    @stack('assets-head')

</head>
<body id="app" class="@yield('body_class')">
    @include('admin::partials.header')

    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-2 bg-light sidebar">
                @section('sidebar')
                @include('admin::partials.sidebar')
                @show
                <button type="button" class="close sidebar-close" aria-label="Close" data-toggle="sidebar">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">
                @section('notice')
                    @include('notice::all')
                @show
                @yield('content')
            </main>
        </div>
    </div>

    <div class="sidebar-backdrop fade"></div>

    @adminScripts
    @stack('assets-base')

    @yield('base')
</body>
</html>
