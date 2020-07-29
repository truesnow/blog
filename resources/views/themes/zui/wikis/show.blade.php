@extends('themes.zui.layouts.app')

@section('title', 'wiki - ' . $wikiSubject->name)

@section('content')

@include('themes.zui.wikis._breadcrumb', compact('wikiSubject'))

@include('themes.zui.wikis._cate', compact('wikiSubject', 'wikiCates', 'cateToItemCountMap'))

<div class="row">
    <div class="with-padding">
        <h1>{{ $wikiSubject->name }}</h1>
        <p>{{ $wikiSubject->desc }}</p>
        <img src="{{ static_url($wikiSubject->cover) }}" alt="" style="width: 200px; height: 100px;">
    </div>
</div>

@stop