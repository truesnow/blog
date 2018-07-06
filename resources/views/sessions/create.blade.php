@extends(theme_prefix() . 'layouts.app')

@section('title', '登录')

@section('content')

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>登录</h5>
            </div>
            <div class="panel-body">
                @include('shares._errors')

                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码（<a href="{{ route('password.request') }}">忘记密码</a>）：</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"> 记住我</label>
                    </div>

                    <button type="submit" class="btn btn-primary">登录</button>
                </form>

                <hr>

                <p>还没账号？<a href="{{ route('signup') }}">注册</a></p>
            </div>
        </div>
    </div>
</div>

@stop