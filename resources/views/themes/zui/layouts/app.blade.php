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
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="//cdn.bootcss.com/zui/1.8.1/css/zui.min.css">
    <link rel="stylesheet" href="{{ asset('css/zui-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/zui-mine.css') }}">
    @yield('css')
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="theme-zui">
    <!-- 低版本 IE 提示升级 -->
    <!--[if lt IE 8]>
        <div class="alert alert-danger">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a href="http://browsehappy.com/">更换一个更好的浏览器</a> 来提升用户体验.</div>
      <![endif]-->
    <div id="app" class="{{ route_class() }}-page">
        @include('themes.zui.layouts._nav')
        @include('themes.zui.mottos._show')
        <div class="container yield-content">
            <!-- @include('shares._messages') -->
            @yield('content')
        </div>
        @include('themes.zui.layouts._footer')
        @if (config('app.debug') && Auth::check())
            @include('sudosu::user-selector')
        @endif
        <!-- <script src="/js/app.js"></script> -->
        <!-- HTML5 标签支持 -->
        <!--[if lt IE 9]>
          <script src="dist/lib/ieonly/html5shiv.js"></script>
        <![endif]-->

        <!-- media query 响应式布局支持 -->
        <!--[if lt IE 9]>
          <script src="dist/lib/ieonly/respond.js"></script>
        <![endif]-->

        <!-- canvas 绘图支持 -->
        <!--[if lt IE 9]>
          <script src="dist/lib/ieonly/excanvas.js"></script>
        <![endif]-->

        <!-- ZUI Javascript 依赖 jQuery -->
        <script src="//cdn.bootcss.com/zui/1.8.1/lib/jquery/jquery.js"></script>
        <!-- ZUI 标准版压缩后的 JavaScript 文件 -->
        <script src="//cdn.bootcss.com/zui/1.8.1/js/zui.min.js"></script>
        <script src="{{ asset('vendor/layer/layer.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('js')
    </div>
</body>
</html>
