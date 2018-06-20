@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-align-justify"></i> Bookmark
                </h1>
            </div>

            <div class="panel-body">
                @if($bookmarks->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th> <th>Url</th> <th>Category_id</th> <th>Description</th> <th>Icon</th>
                                <th class="text-right">OPTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($bookmarks as $bookmark)
                                <tr>
                                    <td class="text-center"><strong>{{$bookmark->id}}</strong></td>

                                    <td>{{$bookmark->name}}</td> <td>{{$bookmark->url}}</td> <td>{{$bookmark->category_id}}</td> <td>{{$bookmark->description}}</td> <td>{{$bookmark->icon}}</td>

                                    <td class="text-right">

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $bookmarks->render() !!}
                @else
                    <h3 class="text-center alert alert-info">Empty!</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection