<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="truesnow">
    <meta name="description" content="@yield('description', 'Sleep, eat, code. TRUESNOW\'s personal website.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - SleepEatCode</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.gif">
    <link rel="stylesheet" href="/css/app.css">
    @yield('css')
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="theme-default">
    <div id="app" class="{{ route_class() }}-page">
        @include('themes.bootstrap.layouts._nav')
        <div class="container">
            @include('shares._messages')
            @yield('content')
        </div>
        @include('themes.bootstrap.layouts._footer')
        @if (config('app.debug') && Auth::check())
        @include('sudosu::user-selector')
        @endif
        <script src="/js/app.js"></script>
        @yield('js')
    </div>
</body>

</html>