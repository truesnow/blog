@extends('layouts.app')

@section('title', '更换头像')

@section('content')

<div class="col-md-3">
    @include('users._profile-menu')
</div>

<div class="col-md-9">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5><i class="glyphicon glyphicon-picture"></i>更换头像</h5>
    </div>
    <div class="panel-body">
      @include('shares._errors')
      <form action="{{ route('users.avatar.update', $user->id) }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="avatar">上传头像：</label>
          <input type="file" name="avatar" id="avatar" class="form-control">
        </div>
        <img class="thumbnail img-responsive" src="{{ empty($user->avatar) ? $user->gravatar() : $user->avatar }}" width="300px" height="300px">
        <div class="well well-sm">
          <button type="submit" class="btn btn-primary">更新</button>
        </div>
      </form>
    </div>
  </div>
</div>

@stop
