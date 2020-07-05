@extends('themes.zui.layouts.app')

@section('title', '里程碑')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/timeliner/css/timeliner.min.css') }}">
@endsection

@section('content')
<div id="timeline" class="timeline-container">
    @if (count($milestones))
    @foreach ($milestones as $milestone)
    <div class="timeline-wrapper">
        <h2 class="timeline-time">{{ $milestone->version }}</h2>
        <dl class="timeline-series">
            <dt class="timeline-event" id="{{ 'event-' . $milestone->version }}"><a>{{ $milestone->content }}</a></dt>
            <dd class="timeline-event-content" id="{{ 'event-content-' . $milestone->version }}">
                <p style="white-space: pre-line;">{{ $milestone->detail }}</p>
            </dd>
        </dl>
    </div>
    <br class="clear">
    @endforeach
    @else
    <p class="text-muted">怎么还没出生喔~</p>
    @endif
</div>
@endsection

@section('js')
<script src="{{ asset('vendor/timeliner/js/timeliner.min.js') }}"></script>
<script>
    $.timeliner({});
</script>
@endsection