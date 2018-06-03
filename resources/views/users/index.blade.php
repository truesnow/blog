@extends('layouts.app')

@section('title', '所有用户')

@section('content')

<div class="col-md-8 col-md-offset-2">
    <h1>所有用户</h1>
    <ul class="users">
        @foreach ($users as $user)
            <li>
                <img src="{{ $user->avatar('30') }}" alt="{{ $user->name }}" class="img img-thumbnail">
                <a href="{{ route('users.show', $user->id) }}" class="username">{{ $user->name }}</a>
                @can('destroy', $user)
                    <form action="{{ route('users.destroy', $user->id) }}" method="post" class="pull-right">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>

                    </form>
                @endcan
            </li>
        @endforeach
    </ul>

    {!! $users->render() !!}
</div>

@stop