<nav class="navbar navbar-inverse" role="navigation">
  <ul class="nav navbar-nav nav-justified">
    <li class="{{ active_class(if_route('home')) }}"><a href="{{ route('home') }}"><i class="icon icon-home"></i>主页</a></li>
    <!-- <li class="{{ active_class(if_uri_pattern('articles*')) }}"><a href="{{ route('articles.index') }}"><i class="icon icon-list-alt"></i>博客</a></li> -->
    <!-- <li class="{{ active_class(if_uri_pattern('subjects*')) }}"><a href="{{ route('subjects.index') }}"><i class="icon icon-list-ul"></i>专题</a></li> -->
    <li class="{{ active_class(if_route('bookmarks.index')) }}"><a href="{{ route('bookmarks.index') }}"><i class="cion icon-bookmark"></i>书签导航</a></li>
    <li class="{{ active_class(if_route('works.index')) }}"><a href="{{ route('works.index') }}"><i class="cion icon-wrench"></i>我的</a></li>
    <li class="{{ active_class(if_route('wikis.index')) }}"><a href="{{ route('wikis.index') }}"><i class="icon icon-cubes"></i>wiki</a></li>
    <li class="{{ active_class(if_route('abbrs')) }}"><a href="{{ route('abbrs') }}" title="计算机专业缩略名词字典"><i class="icon icon-font"></i>ABBR</a></li>
    <!-- <li class="{{ active_class(if_route('messages.index')) }}"><a href="{{ route('messages.index') }}"><i class="icon icon-comment-alt"></i>留言</a></li> -->
    <!-- <li class="dropdown active">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">工具 <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="{{ route('ghtoc') }}">在线生成 GitHub TOC</a></li>
      </ul>
    </li> -->
  </ul>
</nav>