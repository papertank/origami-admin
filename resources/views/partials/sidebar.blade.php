<div class="sidebar-sticky">
  <nav class="sidebar-nav">
    <ul class="nav nav-stacked flex-column">
      <li class="nav-item">
        <a class="nav-link{{ Request::is(admin_path()) ? ' active' : '' }}" href="{{ aurl('') }}">
          <i data-feather="home"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link{{ Request::is(admin_path('users/*')) ? ' active' : '' }}" href="{{ aurl('users') }}">
          <span data-feather="users"></span>
          Users
        </a>
      </li>
    </ul>
  </nav>
</div>
