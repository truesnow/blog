@extends('layouts.app')

@section('title', '注册')

@section('content')

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>注册</h5>
            </div>
            <div class="panel-body">
                @include('shares._errors')

                <form action="{{ route('users.store') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">名称：</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="captcha">验证码：</label>
                        <input type="captcha" name="captcha" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="hidden"></label>
                        <img src="{{ captcha_src('flat') }}" alt="" class="thumbnail captcha" onclick="this.src='/captcha/flat' + Math.random()" title="点击图片重新获取验证码">
                    </div>

                    <button type="submit" class="btn btn-primary">注册</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop