<section>
    <div class="container">
        <nav class="nav">
            <div class="nav-left">
                <a href="{{ url('/') }}" class="nav-item hero-brand">
                    {{ config('app.name', 'MyIO') }}
                </a>
            </div>
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
        </nav>
    </div>
</section>