@extends('layouts.app')

@section('title', '专题')

@section('content')

@foreach ($subjects as $k => $subject)
    @if (($k + 1) % 3 == 1)
        <div class="row subjects">
    @endif
        <div class="col-md-4 text-center subject">
            <h2><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a></h2>
            <p>{{ $subject->description }}</p>
            <p>{{ $subject->article_count }}</p>
        </div>
    @if (($k + 1) % 3 == 0)
        </div>
    @endif
@endforeach

@stop