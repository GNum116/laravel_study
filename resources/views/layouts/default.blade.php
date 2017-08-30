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
    @yield('content')
    @include('layouts._footer')
</div>
</body>
</html>