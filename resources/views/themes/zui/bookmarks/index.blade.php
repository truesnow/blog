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
              @if (count($second_category_item['bookmarks']) == 0)
                <?php continue; ?>
              @endif
              <div class="row">
                <div class="col-md-1">
                  <!-- 二级分类名称 -->
                  <h4>{{ $second_category_item['name'] }}</h4>
                </div>
                <div class="col-md-11">

                      @foreach ($second_category_item['bookmarks'] as $k3 => $bookmark)
                        @if (($k == 0 || ($k + 1) % 4 == 0))
                        <div class="row">
                        @endif
                          <div class="col-md-3">
                            <div class="card" href="###">
                              <!-- <img src="{{ $bookmark['icon'] }}" alt="" class="img img-thumbnail bookmark-icon"> -->
                              <div class="card-heading"><a href="{{ $bookmark['url'] }}" target="_blank" nofollow><strong>{{ $bookmark['name'] }}</strong></a></div>
                              <div class="card-content text-muted">{{ $bookmark['description'] }}</div>
                            </div>
                          </div>
                          @if (($k == 0 || ($k + 1) % 4 == 0))
                          </div>
                          @endif
                      @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>

@stop
