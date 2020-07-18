@extends('themes.zui.layouts.app')

@section('title', '上传资源')

@section('content')

<form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="file">上传文件：</label>
        <input type="file" class="form-control" name="file">
    </div>
    <button type="submit" class="btn btn-primary">提交</button>
</form>

@stop
