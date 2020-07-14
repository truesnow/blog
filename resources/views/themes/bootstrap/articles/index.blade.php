@extends('themes.bootstrap.layouts.app')

@section('title', '博客')

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li class="{{ active_class(!if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=default">最后回复</a></li>
                    <li class="{{ active_class(if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=recent">最新发布</a></li>
                </ul>
            </div>
            <div class="panel-body">
                @include('themes.bootstrap.articles._article_list', compact('articles'))
                {!! $articles->appends(Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
</div>

@endsection