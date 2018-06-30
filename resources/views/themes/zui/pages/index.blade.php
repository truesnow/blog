@extends('themes.zui.layouts.app')
@section('title', 'Home')

@section('content')

<div class="row">
    <div class="col-md-8">
        @include('themes.zui.articles._article_list', compact('articles', 'article_count'))
    </div>
    <div class="col-md-4">
        @include('themes.zui.subjects._nav', compact('subjects'))
    </div>
</div>

@stop