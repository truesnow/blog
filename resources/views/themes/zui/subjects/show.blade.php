@extends('themes.zui.layouts.app')

@section('title', '专题：' . $subject->name)

@section('content')

<div class="list text-center">
    <h2>{{ $subject->name }}</h2>
    <p>{{ $subject->description }}</p>
    <p>共 {{ $subject->article_count }} 篇文章</p>
</div>

@include('themes.zui.articles._article_list', compact('articles'))

@stop
