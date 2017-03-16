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
        
        @include('admin.layouts.partials._header')

        <section class="hero is-bold is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">{{ isset($title) ? $title : 'MyIO' }}</h1>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        @include('admin.layouts.partials._nav')
                    </div>

                    <div class="column is-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>

        @include('admin.layouts.partials._footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>