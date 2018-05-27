@extends('layouts.app')

@section('title', '留言板')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @if (Auth::check())
            @include('shares._errors')
            <form action="{{ route('messages.store') }}" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="content">说点儿什么吧：</label>
                    <textarea name="content" id="content" rows="3" class="form-control"></textarea>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">发布</button>
                </div>
            </form>
        @else
            <div class="well well-md text-center">
                留言请先 <a href="{{ route('login') }}">登录</a>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @if(count($messages) > 0)
            <div class="messages">
                @foreach($messages as $message)
                    @include('messages._message')
                @endforeach
            </div>
            {!! $messages->render() !!}
        @else
            <p>还没有人留言~快来抢沙发吧~</p>
        @endif
    </div>
</div>

@stop