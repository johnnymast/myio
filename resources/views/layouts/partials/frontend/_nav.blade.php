<nav class="nav fixed-nav">

  <div id="nav-menu" class="nav-left nav-menu">
    @if (Auth::check())
      <div class="nav-item">Welcome, {{ Auth::User()->name }}</div>
    @endif
  </div>
      <div id="nav-menu" class="nav-right nav-menu">
        <a class="nav-item" href="{{ route('homepage') }}">
          Home
        </a>
        <a class="nav-item" href="https://github.com/johnnymast/myio">
          About
        </a>

        @if (Auth::check())
            <a class="nav-item" href="{{ route('user.logout') }}">Logout</a>
        @else
              <a class="nav-item" href="{{ route('login') }}">Login</a>
              <a class="nav-item" href="{{ route('register') }}">Signup</a>
        @endif

  </div>
</nav>