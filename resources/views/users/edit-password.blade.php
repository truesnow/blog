@extends('layouts.app')

@section('title', '修改密码')

@section('content')

<div class="col-md-3">
    @include('users._profile-menu')
</div>

<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5><i class="glyphicon glyphicon-lock"></i>修改密码</h5>
        </div>
        <div class="panel-body">
            @include('shares._errors')
            <form action="{{ route('users.password.update', $user->id) }}" method="POST" accept-charset="UTF-8" class="form-horizontal" role="form">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">邮箱：</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">新密码：</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="col-sm-2 control-label">确认新密码：</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@stop