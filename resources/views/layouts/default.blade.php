<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>@yield('title', 'Study App') - Laravel 入门教程</title>

<link rel="stylesheet" href="/css/app.css">
</head>

<body>
@include('layouts._header')

<div class="container">
  <div class="col-md-offset-1 col-md-10">
    @include('shared._message')
    @yield('content')
    @include('layouts._footer')
  </div>
</div>

<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>