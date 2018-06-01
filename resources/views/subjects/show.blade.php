@extends('layouts.app')

@section('title', '专题详情')

@section('content')

@if ($subject->parent_id == 0)
    @include('subjects._parent-show')
@else
    @include('subjects._child-show')
@endif

@stop