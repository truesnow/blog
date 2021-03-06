@extends('themes.bootstrap.layouts.app')

@section('title', $article->title)

@section('description', $article->excerpt)

@section('content')

<div class="row">
    <div class="col-md-2 author">
        <h5>作者：{{ $article->user->name }}</h5>
        <img src="{{ $article->user->avatar('100') }}" alt="{{ $article->user->name }}" class="img img-thumbnail">
    </div>
    <div class="col-md-10">
        <h2 class="text-center">{{ $article->title }}</h2>
        <p class="text-center">
            <span>作者<a href="{{ route('users.show', $article->user->id) }}">{{ $article->user->name }}</a></span>
            {{ $article->created_at->diffForHumans() }}
            收录于 <a href="{{ route('subjects.show', $article->subject_id) }}">{{ $article->subject->name }}</a>
            <span><i class="glyphicon glyphicon-comment"></i>{{ $article->reply_count }}</span>
        </p>
        <div class="article-content simditor-body">
            {!! $article->content !!}
        </div>

        <div class="operate">
            @can('update', $article)
            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span>编辑</a>
            @endcan
            @can('destroy', $article)
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span>删除</button>
            </form>
            @endcan
        </div>

        <div class="panel panel-default article-reply">
            <div class="panel-body">
                @include('themes.bootstrap.articles._reply_box', compact('article'))
                @include('themes.bootstrap.articles._reply_list', ['replies' => $article->replies()->with('user')->get()])
            </div>
        </div>

    </div>
</div>

@endsection