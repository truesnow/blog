@extends('layouts.app')

@section('title', '个人中心')

@section('content')

<img src="{{ $user->gravatar() }}" alt="{{ $user->name }}">
<br>

{{ $user->name }}
<br>
{{ $user->email }}

@stop