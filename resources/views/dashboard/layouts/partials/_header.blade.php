<section>
    <div class="container">
        <nav class="nav">
            <div class="nav-left">
                <a href="{{ url('/') }}" class="nav-item hero-brand">
                    {{ config('app.name', 'MyIO') }}
                </a>
            </div>
            @if ( \Auth::check() )
                <div class="nav-right is-flex">
                    <span class="nav-item">Welcome, {{ \Auth::user()->name }}!</span>
                    <span class="nav-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="button is-primary">
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
                </div>
            @else
                <div class="nav-right is-flex">
                    <span class="nav-item">
                        <a href="{{ route('login') }}" class="button is-primary">
                            <span>Login</span>
                        </a>

                        <a href="{{ route('register') }}" class="button is-primary">
                            <span>Register</span>
                        </a> 
                    </span>
                </div>
            @endif
        </nav>
    </div>
</section>