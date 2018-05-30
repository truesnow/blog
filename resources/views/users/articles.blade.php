@extends('users._show-layout')

@section('title', '文章|个人中心')

@section('user-data')

@if (count($articles) > 0)

    <div class="articles">
        @foreach ($articles as $article):
            <div class="article">
                <h2>{{ $article->title }}</h2>
                <div>发表于：{{ $article->created_at->diffForHumans() }} 收录到专题：{{ $article->subject->name }} 阅读：{{ $article->view_count }} 回复：{{ $article->reply_count }} </div>
                <p>{{ $article->content }}</p>
            </div>
            <hr>
        @endforeach
    </div>
    {!! $articles->render() !!}

@else

<p>还没有发表过文章哦~</p>

@endif

@stop
