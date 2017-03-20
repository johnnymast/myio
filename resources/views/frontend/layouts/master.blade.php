<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta id="token" content="{{ csrf_token() }}" name="token">
  <title>Myio Link Shortener</title>
  <link rel="stylesheet" href="/css/app.css">

</head>
<body>
<div class="site-content">
    @include('frontend.layouts.partials._nav')

    @if (Session::get('flash_notification.message'))
      @include('frontend.layouts.partials._flash')
    @endif

    @yield('content')

</div>

@include('frontend.layouts.partials._footer')

<script src="/js/app.js"></script>

</body>
</html>