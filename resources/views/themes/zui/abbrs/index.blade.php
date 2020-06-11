@extends('themes.zui.layouts.app')

@section('title', '计算机缩略词大全')

@section('css')
<style>
    #abbrSearchBox {
        padding-bottom: 30px;
    }

    .abbr-nav .label {
        float: right;
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
    <div class="input-control search-box search-box-circle has-icon-left has-icon-right" id="abbrSearchBox">
        <input type="search" id="abbrSearchInput" autofocus="autofocus" class="form-control search-input" placeholder="输入缩略词名称或全称关键字搜索">
        <label for="abbrSearchInput" class="input-control-icon-left search-icon"><i class="icon icon-search"></i></label>
        <a href="#" class="input-control-icon-right search-clear-btn"><i class="icon icon-remove"></i></a>
    </div>

    <div class="col-md-2">
        {{--字母范围导航--}}
        <div class="abbr-nav">
            <ul class="nav nav-secondary nav-stacked">
                <li{!! showActiveClass('') !!}><a href="{{ route('abbrs.index') }}">全部 <span class="label label-badge">{{ $countMap['total'] }}</span></a></li>
                <li{!! showActiveClass('a-g') !!}><a href="{{ route('abbrs.index', ['range' => 'a-g']) }}">A-G <span class="label label-badge">{{ $countMap['ag'] }}</span></a></li>
                <li{!! showActiveClass('h-n') !!}><a href="{{ route('abbrs.index', ['range' => 'h-n']) }}">H-N <span class="label label-badge">{{ $countMap['hn'] }}</span></a></li>
                <li{!! showActiveClass('opq') !!}><a href="{{ route('abbrs.index', ['range' => 'opq']) }}">OPQ <span class="label label-badge">{{ $countMap['opq'] }}</span></a></li>
                <li{!! showActiveClass('rst') !!}><a href="{{ route('abbrs.index', ['range' => 'rst']) }}">RST <span class="label label-badge">{{ $countMap['rst'] }}</span></a></li>
                <li{!! showActiveClass('uvw') !!}><a href="{{ route('abbrs.index', ['range' => 'uvw']) }}">UVW <span class="label label-badge">{{ $countMap['uvw'] }}</span></a></li>
                <li{!! showActiveClass('xyz') !!}><a href="{{ route('abbrs.index', ['range' => 'xyz']) }}">XYZ <span class="label label-badge">{{ $countMap['xyz'] }}</span></a></li>
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
        <div class="row">
            @endif
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-heading">{{ $abbr['abbr'] }}</div>
                    <div class="panel-body">
                        <p class="hl-green">{{ $abbr['full_name'] }}</p>
                        <p class="hl-yellow">{{ $abbr['cn_name'] }}</p>
                        <small class="text-muted">{{ $abbr['desc'] }}</small>
                    </div>
                </div>
            </div>

            @if ($i % 4 == 0)
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
<script src="//cdnjs.cloudflare.com/ajax/libs/zui/1.9.1/js/zui.min.js"></script>
<script>
    $(function() {
        $('#abbrSearchBox').searchBox({
            escToClear: true,
            onSearchChange: function(searchContent, isEmpty) {
                console.log('缩略词搜索变更：', searchContent);
            }
        })
    });
</script>

@stop