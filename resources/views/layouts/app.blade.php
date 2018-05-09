<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="truesnow">
    <meta name="description" content="Sleep, eat, code. TRUESNOW's personal website.">
    <title>@yield('title') - SLEEP EAT CODE</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.gif">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="theme-default">
    @include('layouts._nav')
    <div class="container">
        @include('shares._messages')
        @yield('content')
    </div>
    @include('layouts._footer')
    <script src="/js/app.js"></script>
</body>
</html>