@extends('themes.bootstrap.layouts.app')
@section('title', '首页')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        @include('themes.bootstrap.mottos._show', compact('motto'))
    </div>
</div>

@stop