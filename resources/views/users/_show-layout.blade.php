@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div class="text-center">
                        <img class="thumbnail img-responsive" src="{{ empty($user->avatar) ? $user->gravatar() : $user->avatar }}" width="300px" height="300px">
                    </div>
                    @if (Auth::check() && Auth::user()->id === $user->id)
                        <div class="text-center">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-edit"></i>  编辑个人资料</a>
                        </div>
                    @endif
                    <div class="media-body">
                        <hr>
                        <h4><strong>个人简介</strong></h4>
                        <p>{{ $user->introduction }}</p>
                        <hr>
                        <h4><strong>注册于</strong></h4>
                        <p>{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="list-group text-center">
                    <?php $user_desc = (Auth::check() && Auth::user()->id == $user->id) ? '我的' : 'Ta的'; ?>
                    <a href="{{ route('users.messages', $user->id) }}" class="list-group-item">{{ $user_desc }}留言</a>
                    <a href="{{ route('users.articles', $user->id) }}" class="list-group-item">{{ $user_desc }}文章</a>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <span>
                    <h1 class="panel-title pull-left" style="font-size:30px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
                </span>
            </div>
        </div>
        <hr>

        {{-- 用户发布的内容 --}}
        <div class="panel panel-default">
            <div class="panel-body">
                @yield('user-data', '暂无数据~_~')
            </div>
        </div>

    </div>
</div>
@stop
