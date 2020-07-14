@extends('themes.bootstrap.layouts.app')

@section('title', '书签导航')

@section('content')

<div class="row">
    <ul id="bookmarks_nav" class="nav nav-tabs" role="tablist">
        @foreach ($bookmarks as $k => $first_category)
        <li class="{{ $k == 0 ? 'active' : '' }}">
            <a href="#category_{{ $first_category['id'] }}" role="tab" data-toggle="tab" aria-expanded="false">{{ $first_category['name'] }}</a>
        </li>
        @endforeach
    </ul>

    <div id="bookmarks" class="tab-content">
        @foreach ($bookmarks as $k1 => $first_category_item)
        <div class="tab-pane {{ $k1 == 0 ? 'active' : '' }}" id="category_{{ $first_category_item['id'] }}">
            @foreach ($first_category_item['children'] as $k2 => $second_category_item)
                <h3>{{ $second_category_item['name'] }}</h3>
                @foreach ($second_category_item['bookmarks'] as $k3 => $bookmark)
                    <div class="bookmark">
                        <!-- <img src="{{ $bookmark['icon'] }}" alt="" class="img img-thumbnail bookmark-icon"> -->
                        <a href="{{ $bookmark['url'] }}" target="_blank">{{ $bookmark['name'] }}</a>
                    </div>
                @endforeach
            @endforeach
        </div>
        @endforeach
    </div>
</div>

@stop