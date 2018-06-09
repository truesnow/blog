<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ route('home') }}">SEC</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ active_class(if_route('home')) }}"><a href="{{ route('home') }}">主页</a></li>
                <li class="{{ active_class(if_uri_pattern('articles*')) }}"><a href="{{ route('articles.index') }}">博客</a></li>
                <li class="{{ active_class(if_uri_pattern('subjects*')) }}"><a href="{{ route('subjects.index') }}">专题</a></li>
                <li class="{{ active_class(if_route('messages.index')) }}"><a href="{{ route('messages.index') }}">留言</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li><a href="{{ route('users.index') }}">用户列表</a></li>
                    @if (Auth::user()->is_admin)
                    <!-- 创建文章 -->
                        <li><a href="{{ route('articles.create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li>
                    @endif
                    <li>
                        <a href="{{ route('notifications.index') }}" class="notifications-badge">
                            <span class="badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }}" title="消息提醒">
                                {{ Auth::user()->notification_count }}
                            </span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                <img src="{{ empty(Auth::user()->avatar) ? Auth::user()->gravatar(30) : Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                            {{ Auth::user()->name }} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            @if (Auth::user()->is_admin)
                            <li><a href="/horizon">Horizon</a></li>
                            @endif
                            <li><a href="{{ route('users.show', Auth::user()->id) }}">个人中心</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" id="logout">
                                    <form action="{{ route('logout') }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('signup') }}">注册</a></li>
                    <li><a href="{{ route('login') }}">登录</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>