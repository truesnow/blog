<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <!-- 导航头部 -->
    <div class="navbar-header">
      <!-- 移动设备上的导航切换按钮 -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-sec">
        <span class="sr-only">切换导航</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- 品牌名称或logo -->
      <!-- <a class="navbar-brand" href="/">SEC</a> -->
    </div>
    <!-- 导航项目 -->
    <div class="collapse navbar-collapse navbar-collapse-sec">
      <!-- 一般导航项目 -->
      <ul class="nav navbar-nav nav-justified">
        <li class="{{ active_class(if_route('home')) }}"><a href="{{ route('home') }}"><i class="icon icon-home"></i>主页</a></li>
        <li class="{{ active_class(if_uri_pattern('articles*')) }}"><a href="{{ route('articles.index') }}"><i class="icon icon-list-alt"></i>博客</a></li>
        <li class="{{ active_class(if_uri_pattern('subjects*')) }}"><a href="{{ route('subjects.index') }}"><i class="icon icon-list-ul"></i>专题</a></li>
        <li class="{{ active_class(if_route('bookmarks.index')) }}"><a href="{{ route('bookmarks.index') }}"><i class="cion icon-bookmark"></i>书签导航</a></li>
        <li class="{{ active_class(if_route('messages.index')) }}"><a href="{{ route('messages.index') }}"><i class="icon icon-comment-alt"></i>留言</a></li>
      </ul>
    </div><!-- END .navbar-collapse -->
  </div>
</nav>

<!-- <nav class="navbar navbar-inverse" role="navigation">
  <ul class="nav navbar-nav nav-justified">
    <li class="{{ active_class(if_route('home')) }}"><a href="{{ route('home') }}"><i class="icon icon-home"></i>主页</a></li>
    <li class="{{ active_class(if_uri_pattern('articles*')) }}"><a href="{{ route('articles.index') }}"><i class="icon icon-list-alt"></i>博客</a></li>
    <li class="{{ active_class(if_uri_pattern('subjects*')) }}"><a href="{{ route('subjects.index') }}"><i class="icon icon-list-ul"></i>专题</a></li>
    <li class="{{ active_class(if_route('bookmarks.index')) }}"><a href="{{ route('bookmarks.index') }}"><i class="cion icon-bookmark"></i>书签导航</a></li>
    <li class="{{ active_class(if_route('messages.index')) }}"><a href="{{ route('messages.index') }}"><i class="icon icon-comment-alt"></i>留言</a></li>
  </ul>
</nav> -->