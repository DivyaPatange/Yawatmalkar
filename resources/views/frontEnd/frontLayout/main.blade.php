<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Yawatmalkar - @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('frontEnd.frontLayout.stylesheet')
  @yield('customcss')
  
</head>

<body>
@include('frontEnd.frontLayout.navbar')
  

  @yield('content')


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  @include('frontEnd.frontLayout.script')
  @yield('customjs')
</body>

</html>