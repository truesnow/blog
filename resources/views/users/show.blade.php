@extends('layouts.app')

@section('title', '个人中心')

@section('content')

{{ $user->name }}
<br>
{{ $user->email }}

@stop