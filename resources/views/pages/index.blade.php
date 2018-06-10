@extends('layouts.app')
@section('title', 'Home')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        @include('mottos._show', compact('motto'))
    </div>
</div>

@stop