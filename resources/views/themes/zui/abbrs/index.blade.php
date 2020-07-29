@extends('themes.zui.layouts.app')

@section('title', '计算机专业缩略名词字典')

@section('css')
<style>
    #abbrSearchGroup {
        margin-bottom: 30px;
    }

    .abbr-nav .label {
        float: right;
    }

    .abbrDesc {
        word-break: break-word;
    }
</style>
@stop

<?php
/**
 * 是否显示 active 类
 */
function showActiveClass($val)
{
    return request()->range == $val ? ' class="active"' : '';
}
?>
@section('content')
<div class="row abbrs-wrap">
    {{--搜索框--}}
    <div class="input-group" id="abbrSearchGroup">
        <div class="input-control search-box search-box-circle has-icon-left has-icon-right" id="abbrSearchBox">
            <input type="search" id="abbrSearchInput" autofocus="autofocus" class="form-control search-input" placeholder="输入缩略词名称或全称关键字搜索" value="{{ request()->search }}">
            <label for="abbrSearchInput" class="input-control-icon-left search-icon"><i class="icon icon-search"></i></label>
            <a href="#" class="input-control-icon-right search-clear-btn"><i class="icon icon-remove"></i></a>
        </div>
        <span class="input-group-btn">
            <button class="btn btn-grey" type="button">搜索</button>
        </span>
    </div>

    <div class="col-md-2">
        {{--字母范围导航--}}
        <div class="abbr-nav">
            <ul class="nav nav-secondary nav-stacked">
                <li{!! showActiveClass('') !!}><a href="{{ route('abbrs') }}">全部 <span class="label label-badge">{{ $countMap['total'] }}</span></a></li>
                    <li{!! showActiveClass('a-g') !!}><a href="{{ route('abbrs', ['range' => 'a-g']) }}">A-G <span class="label label-badge">{{ $countMap['ag'] }}</span></a></li>
                        <li{!! showActiveClass('h-n') !!}><a href="{{ route('abbrs', ['range' => 'h-n']) }}">H-N <span class="label label-badge">{{ $countMap['hn'] }}</span></a></li>
                            <li{!! showActiveClass('opq') !!}><a href="{{ route('abbrs', ['range' => 'opq']) }}">OPQ <span class="label label-badge">{{ $countMap['opq'] }}</span></a></li>
                                <li{!! showActiveClass('rst') !!}><a href="{{ route('abbrs', ['range' => 'rst']) }}">RST <span class="label label-badge">{{ $countMap['rst'] }}</span></a></li>
                                    <li{!! showActiveClass('uvw') !!}><a href="{{ route('abbrs', ['range' => 'uvw']) }}">UVW <span class="label label-badge">{{ $countMap['uvw'] }}</span></a></li>
                                        <li{!! showActiveClass('xyz') !!}><a href="{{ route('abbrs', ['range' => 'xyz']) }}">XYZ <span class="label label-badge">{{ $countMap['xyz'] }}</span></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-9" id="abbrList">
        @if (!count($abbrs))
        <p class="text-muted">空空如也~</p>
        @else
        <?php $i = 1; ?>
        @foreach ($abbrs as $abbr)
        @if ($i % 4 == 1)
        <!-- 每行显示 4 个 -->
        <div class="row">
            @endif
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-heading">{{ $abbr['abbr'] }}</div>
                    <div class="panel-body">
                        <p class="hl-green">{{ $abbr['full_name'] }}</p>
                        <p class="hl-yellow">{{ $abbr['cn_name'] }}</p>
                        <small class="text-muted abbrDesc">{{ $abbr['desc'] }}</small>
                    </div>
                </div>
            </div>

            @if ($i % 4 == 0 || ($i == count($abbrs)))
            <!-- 行 div 闭合（最后不满 4 个时要闭合） -->
        </div>
        @endif
        <?php $i++ ?>
        @endforeach
        @endif
        <div class="pages">
            {!! $abbrs->appends(Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="//cdn.bootcss.com/zui/1.9.1/js/zui.min.js"></script>
<script>
    $(function() {
        $('#abbrSearchBox').searchBox({
            escToClear: true,
            onSearchChange: function(searchContent, isEmpty) {},
            onPressEnter: function(event) {
                doSearch();
            }
        })
        $('#abbrSearchGroup button').on('click', function(ele, event) {
            doSearch();
        })

        function doSearch() {
            // 获取搜索框实例对象
            var mySearchBox = $('#abbrSearchBox').data('zui.searchBox');
            // 获取搜索框内的文本
            var searchContent = mySearchBox.getSearch();
            location.href = window.location.origin + window.location.pathname + '?search=' + searchContent
        }
    });
</script>

@stop