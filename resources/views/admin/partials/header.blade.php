<nav class="navbar navbar-top navbar-dark navbar-expand sticky-top flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ aurl('') }}">{{ config('app.name') }}</a>
    <button class="nav-toggler sidebar-toggler" type="button" data-toggle="sidebar">
        <span class="sr-only">Toggle nav</span>
    </button>
    {!! Form::open(['url' => aurl('search'), 'method' => 'GET', 'class' => 'form-search']) !!}
        <input name="q" class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    {!! Form::close() !!}
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <div class="dropdown show">
              <a class="dropdown-toggle" href="#" role="button" id="account-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ request()->user('admin')->avatarUrl() }}" class="rounded-circle navbar-avatar" />
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="account-dropdown">
                <a class="dropdown-item" href="{{ aurl('logout') }}" data-method="post">Log out</a>
              </div>
            </div>
        </li>
    </ul>
</nav>
