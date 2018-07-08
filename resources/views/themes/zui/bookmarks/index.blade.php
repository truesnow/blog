@extends('themes.zui.layouts.app')

@section('title', '书签导航')

@section('content')

<div class="row bookmarks-wrap">
    <ul class="nav nav-tabs bookmarks-nav" role="tablist">
        @foreach ($bookmarks as $k => $first_category)
        <li class="{{ $k == 0 ? 'active' : '' }}">
            <a href="#category_{{ $first_category['id'] }}" role="tab" data-toggle="tab" aria-expanded="false">{{ $first_category['name'] }}</a>
        </li>
        @endforeach
    </ul>

    <div class="tab-content bookmarks">
        <!-- 标签一级分类块 -->
        @foreach ($bookmarks as $k1 => $first_category_item)
        <div class="tab-pane {{ $k1 == 0 ? 'active' : '' }}" id="category_{{ $first_category_item['id'] }}">
            @foreach ($first_category_item['children'] as $k2 => $second_category_item)
            <?php $bookmark_count = count($second_category_item['bookmarks']);  ?>
              @if ($bookmark_count == 0)
                <?php continue; ?>
              @endif
              <div class="row">
                <div class="col-md-1">
                  <!-- 二级分类名称 -->
                  <h4 class="text-center">{{ $second_category_item['name'] }}</h4>
                </div>
                <div class="col-md-11">

                  <div class="cards cards-condensed">
                      @foreach ($second_category_item['bookmarks'] as $k3 => $bookmark)
                        @if ($k3 == 0)
                        @endif
                          <div class="col-md-3">
                            <a class="card" href="{{ $bookmark['url'] }}" target="_blank">
                              <img src="{{ static_url($bookmark['icon']) }}" alt="" class="img img-thumbnail bookmark-icon">
                              <div class="card-heading"><strong>{{ $bookmark['name'] }}</strong></div>
                              <div class="card-content text-muted">{{ $bookmark['description'] }}</div>
                            </a>
                          </div>
                          @if (($k3 + 1 == $bookmark_count) || ($k3 + 1) % 4 == 0)
                          @endif
                      @endforeach
                  </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>

@stop
