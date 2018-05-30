@extends('users._show-layout')

@section('title', '留言|个人中心')

@section('user-data')

@if (count($messages) > 0)

    @foreach ($messages as $message):
        @include('messages._message')
    @endforeach
    {!! $messages->render() !!}

@else

<p>还没有留过言哦~</p>

@endif

@stop
