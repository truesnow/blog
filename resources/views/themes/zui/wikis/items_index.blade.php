<?php

use App\Models\WikiCate;
?>
@extends('themes.zui.layouts.app')

@section('title', 'wiki - ' . $wikiSubject->name . ' - ' . $wikiCate->name)

@section("css")
<style>
  .wiki-item-img {
    width: 200px;
    height: 300px;
  }
</style>
@stop

@section('content')

@include('themes.zui.wikis._breadcrumb', compact('wikiSubject', 'wikiCates'))

@include('themes.zui.wikis._cate', compact('wikiSubject', 'wikiCates', 'cateToItemCountMap'))

@if ($wikiCate->resource_type == WikiCate::RESOURCE_TYPE_LINK)
<!-- 链接资源 -->
<ul class="list-group with-padding">
  @foreach ($wikiItems as $wikiItem)
  <li class="list-group-item">
    <a href="{{ $wikiItem->url }}" target="_blank">{{ $wikiItem->name }}</a>
    <p class="text-muted">{{ $wikiItem->desc }}</p>
  </li>
  @endforeach
</ul>

@elseif ($wikiCate->resource_type == WikiCate::RESOURCE_TYPE_IMAGE)
<!-- 图片资源 -->
<div class="wrapper" style="margin-top: 10px;">
  @foreach ($wikiItems as $wikiItem)
  <a href="{{ $wikiItem->url }}" data-toggle="lightbox" data-caption="{{ $wikiItem->desc }}" data-group="wiki-subject-{{ $wikiSubject->id }}-cate-{{ $wikiCate->id }}">
    <img src="{{ $wikiItem->url }}" class="img-rounded  wiki-item-img" alt="{{ $wikiItem->name }}">
  </a>
  @endforeach
</div>

@elseif ($wikiCate->resource_type == WikiCate::RESOURCE_TYPE_TEXT)
<!-- 文本资源 -->
<ul class="list-group with-padding">
  @foreach ($wikiItems as $wikiItem)
  <li class="list-group-item">
    <a href="{{ route('wikis.items.show', ['wikiSubject' => $wikiSubject->id, 'wikiCate' => $wikiCate->id, 'wikiItem' => $wikiItem->id]) }}" target="_blank">{{ $wikiItem->name }}</a>
    <p class="text-muted">{{ $wikiItem->desc }}</p>
  </li>
  @endforeach
</ul>
@endif

@stop