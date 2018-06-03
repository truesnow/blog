@extends('users._show-layout')

@section('title', '文章|个人中心')

@section('user-data')

@include('articles._article_list', compact('articles'))

@stop
