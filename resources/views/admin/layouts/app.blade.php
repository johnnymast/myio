<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
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

        <section class="hero is-bold is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">title-here</h1>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <aside class="menu box">
                            <p class="menu-label">
                                Navigation
                            </p>
                            <ul class="menu-list">
                                <li>
                                    <a href="{{ route('url_create') }}" class="is-active">Create</a>
                                </li>
                            </ul>
                        </aside>
                    </div>

                    <div class="column is-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
