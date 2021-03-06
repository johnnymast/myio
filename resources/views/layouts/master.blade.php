<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta id="token" content="{{ csrf_token() }}" name="token">
  <title>Myio Link Shortener</title>
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

</head>
<body>
  <div id="app">
    <div class="site-content">
      @include('layouts.partials.frontend._nav')

      @if (Session::get('flash_notification.message'))
        @include('layouts.partials.frontend._flash')
      @endif

      @yield('content')

    </div>
  </div>

  @include('layouts.partials.frontend._footer')

<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>