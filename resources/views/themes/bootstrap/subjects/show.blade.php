@extends('themes.bootstrap.layouts.app')

@section('title', '专题详情')

@section('content')

@if ($subject->parent_id == 0)
@include('themes.bootstrap.subjects._parent_show')
@else
@include('themes.bootstrap.subjects._child_show')
@endif

@stop