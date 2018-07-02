<nav class="navbar navbar-inverse" role="navigation">
  <ul class="nav navbar-nav nav-justified">
    <li class="{{ active_class(if_route('home')) }}"><a href="{{ route('home') }}"><i class="icon icon-home"></i>主页</a></li>
    <!-- <li class="{{ active_class(if_uri_pattern('articles*')) }}"><a href="{{ route('articles.index') }}"><i class="icon icon-list-alt"></i>博客</a></li> -->
    <!-- <li class="{{ active_class(if_uri_pattern('subjects*')) }}"><a href="{{ route('subjects.index') }}"><i class="icon icon-list-ul"></i>专题</a></li> -->
    <li class="{{ active_class(if_route('bookmarks.index')) }}"><a href="{{ route('bookmarks.index') }}"><i class="cion icon-bookmark"></i>书签导航</a></li>
    <li class="{{ active_class(if_route('works.index')) }}"><a href="{{ route('works.index') }}"><i class="cion icon-wrench"></i>我的</a></li>
    <li class="{{ active_class(if_route('messages.index')) }}"><a href="{{ route('messages.index') }}"><i class="icon icon-comment-alt"></i>留言</a></li>
  </ul>
</nav>