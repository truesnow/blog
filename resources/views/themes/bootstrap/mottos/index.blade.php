@extends('themes.bootstrap.layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-align-justify"></i> Motto
                    <a class="btn btn-success pull-right" href="{{ route('mottoes.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
                </h1>
            </div>

            <div class="panel-body">
                @if($mottoes->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Author</th>
                            <th>Source</th>
                            <th>Portrait</th>
                            <th>Content</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($mottoes as $motto)
                        <tr>
                            <td class="text-center"><strong>{{$motto->id}}</strong></td>

                            <td>{{$motto->author}}</td>
                            <td>{{$motto->source}}</td>
                            <td>{{$motto->portrait}}</td>
                            <td>{{$motto->content}}</td>

                            <td class="text-right">
                                <a class="btn btn-xs btn-primary" href="{{ route('mottoes.show', $motto->id) }}">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>

                                <a class="btn btn-xs btn-warning" href="{{ route('mottoes.edit', $motto->id) }}">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>

                                <form action="{{ route('mottoes.destroy', $motto->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $mottoes->render() !!}
                @else
                <h3 class="text-center alert alert-info">Empty!</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection