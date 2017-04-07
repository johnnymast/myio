<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

</head>
<body>
@include('layouts.partials.admin._nav')
<div class="columns">
  @include('layouts.partials.admin._sidebar')

  <div class="content column is-10" id="app">
    @yield('content')
  </div>
</div>
@include('layouts.partials.admin._footer')

<script src="/js/clipboard.min.js"></script>
<script src="{{ mix('/js/admin.js') }}"></script>

@yield('footer.scripts')
</body>
</html>
