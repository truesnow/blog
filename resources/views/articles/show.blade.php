@extends('layouts.app')

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
            {{ $article->updated_at->diffForHumans() }}
        </p>
        <div class="article-content simditor-body">
            {!! $article->content !!}
        </div>
    </div>
</div>

@endsection
