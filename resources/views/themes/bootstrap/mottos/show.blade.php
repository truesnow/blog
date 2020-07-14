@extends('themes.bootstrap.layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Motto / Show #{{ $motto->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('mottoes.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-sm btn-warning pull-right" href="{{ route('mottoes.edit', $motto->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Author</label>
                <p>
                    {{ $motto->author }}
                </p> <label>Source</label>
                <p>
                    {{ $motto->source }}
                </p> <label>Portrait</label>
                <p>
                    {{ $motto->portrait }}
                </p> <label>Content</label>
                <p>
                    {{ $motto->content }}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection