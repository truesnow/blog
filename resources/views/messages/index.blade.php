@extends('layouts.app')

@section('title', '留言板')

@section('content')

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