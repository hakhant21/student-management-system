<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်') }} | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist') }}/css/adminlte.min.css">
  <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=pyidaungsu'>
  <style type="text/css">
    @font-face {
    font-family: 'pyidaungsuregular';
      src: url({{asset('pyidaungsu-webfont.woff2')}}) format('woff2'),
          url({{asset('pyidaungsu-webfont.woff')}}) format('woff');
      font-weight: normal;
      font-style: normal;
    }
  </style>
</head>
<body class="hold-transition login-page">

  @yield('content')

<!-- jQuery -->
<script src="{{ asset('plugins') }}/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist') }}/js/adminlte.min.js"></script>
</body>
</html>
