<?php

use App\Models\Work;
?>

@extends('themes.zui.layouts.app')

@section('title', '我的作品')

@section('content')

@foreach ($works as $category => $work_list)
<h1>{{ array_get(Work::$category_map, $category, '我的作品') }}</h1>
<div class="cards cards-borderless">
    @foreach ($work_list as $work)
    <div class="col-md-4 col-sm-6 col-lg-3">
      <a class="card work-url" href="{{ $work['url'] }}" target="_blank">
        <img src="{{ static_url($work['image']) }}" alt="" class="work-image">
        <!-- <div class="caption"></div> -->
        <div class="card-heading"><strong>{{ $work['name'] }}</strong></div>
        <div class="card-content text-muted">{{ $work['description'] }}</div>
      </a>
    </div>
    @endforeach
</div>
@endforeach

@stop

@section('js')
<script>
    $(function () {
        $('.work-url').on('click', function (e) {
            $.recordRedirect('works', $(this).attr('href'));
        });
    });
</script>

@stop