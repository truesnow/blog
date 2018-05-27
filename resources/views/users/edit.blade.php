@extends('layouts.app')

@section('title', '更新个人资料')

@section('content')

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>更新个人资料</h5>
        </div>
        <div class="panel-body">
            @include('shares._errors')

            <form action="{{ route('users.update', $user->id) }}" method="POST" class="">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="name">用户名：</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">邮箱：</label>
                    <input type="email" name="email" value="{{ $user->email }}"  class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="introduction">个人简介：</label>
                    <textarea name="introduction" id="introduction" rows="3" class="form-control">{{ $user->introduction }}</textarea>
                </div>
                <!-- <div class="form-group">
                    <label for="password">密码：</label>
                    <input type="password" name="password"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">确认密码：</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div> -->
                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>

@stop