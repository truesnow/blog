@extends('layouts.app')

@section('title', '博客')

@section('content')

<div class="row">
    <ul id="bookmarks_nav" class="nav nav-tabs" role="tablist">
        @foreach ($first_categories as $k => $first_category)
        <li class="">
            <a href="#category_{{ $first_category['id'] }}" role="tab" data-toggle="tab" aria-expanded="false">{{ $first_category['name'] }}</a>
        </li>
        @endforeach
    </ul>

    <div id="bookmarks" class="tab-content">
        @foreach ($bookmarks as $k1 => $first_category_item)
        <div class="tab-pane" id="category_{{ $first_category_item['id'] }}">
            @foreach ($first_category_item['children'] as $k2 => $second_category_item)
                <h3>{{ $second_category_item['name'] }}</h3>
                @foreach ($second_category_item['bookmarks'] as $k3 => $bookmark)
                    <div class="bookmark">
                        <img src="{{ $bookmark['icon'] }}" alt="" class="img img-thumbnail bookmark-icon">
                        <a href="{{ $bookmark['url'] }}" target="_blank">{{ $bookmark['name'] }}</a>
                    </div>
                @endforeach
            @endforeach
        </div>
        @endforeach
        <div class="tab-pane" id="rule" data-toggle="tab">规则内容面板</div>
        <div class="tab-pane active" id="forum" data-toggle="tab">论坛内容面板</div>
        <div class="tab-pane" id="security" data-toggle="tab">安全内容面板</div>
        <div class="tab-pane" id="welfare" data-toggle="tab">公益内容面板</div>
    </div>
</div>

@stop