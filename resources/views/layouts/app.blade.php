<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="truesnow">
    <meta name="description" content="Sleep, eat, code. TRUESNOW's personal website.">
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
    @include('layouts._nav')
    <div class="container">
        @include('shares._messages')
        @yield('content')
    </div>
    @include('layouts._footer')
    <script src="/js/app.js"></script>
    @yield('js')
</body>
</html>