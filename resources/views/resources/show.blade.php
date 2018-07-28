@extends('layouts.app')

@section('title', '查看资源')

@section('content')

<table class="table text-center">
    <tbody>
        <tr>
            <th>资源名称</th>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <th>资源链接</th>
            <td>{{ $url }}</td>
        </tr>
        <tr>
            <th>资源内容</th>
            <td><img src="{{ $url }}" alt="{{ $name }}"></td>
        </tr>
    </tbody>
</table>

@stop