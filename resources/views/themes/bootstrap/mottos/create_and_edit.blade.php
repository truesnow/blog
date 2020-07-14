@extends('themes.bootstrap.layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Motto /
                    @if($motto->id)
                    Edit #{{$motto->id}}
                    @else
                    Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($motto->id)
                <form action="{{ route('mottoes.update', $motto->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
                    @else
                    <form action="{{ route('mottoes.store') }}" method="POST" accept-charset="UTF-8">
                        @endif

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group">
                            <label for="author-field">Author</label>
                            <input class="form-control" type="text" name="author" id="author-field" value="{{ old('author', $motto->author ) }}" />
                        </div>
                        <div class="form-group">
                            <label for="source-field">Source</label>
                            <input class="form-control" type="text" name="source" id="source-field" value="{{ old('source', $motto->source ) }}" />
                        </div>
                        <div class="form-group">
                            <label for="portrait-field">Portrait</label>
                            <input class="form-control" type="text" name="portrait" id="portrait-field" value="{{ old('portrait', $motto->portrait ) }}" />
                        </div>
                        <div class="form-group">
                            <label for="content-field">Content</label>
                            <textarea name="content" id="content-field" class="form-control" rows="3">{{ old('content', $motto->content ) }}</textarea>
                        </div>

                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-link pull-right" href="{{ route('mottoes.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection