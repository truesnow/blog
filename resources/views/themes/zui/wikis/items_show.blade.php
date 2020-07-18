@extends('themes.zui.layouts.app')

@section('title', $wikiItem->name . ' - ' . $wikiCate->name . ' - wiki - ' . $wikiSubject->name)

@section('content')

<ol class="breadcrumb">
    <li><a href="{{ route('home') }}">首页</a></li>
    <li><a href="{{ route('wikis.index') }}">wiki</a></li>
    <li><a href="{{ route('wikis.show', ['wikiSubject' => $wikiSubject->id]) }}">{{ $wikiSubject->name }}</a></li>
    <li><a href="{{ route('wikis.items.index', ['wikiSubject' => $wikiSubject->id, 'wikiCate' => $wikiCate->id]) }}">{{ $wikiCate->name }}</a></li>
    <li class="active">{{ $wikiItem->name }}</li>
</ol>

@include('themes.zui.common._markdown_show', ['title' => $wikiItem->name, 'content' => $textContent->content ])

@stop