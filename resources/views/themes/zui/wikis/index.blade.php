@extends('themes.zui.layouts.app')

@section('title', 'wiki')

@section('css')
<style>
    .wikiSubjectsCard {
        height: 200px;
    }

    .card img {
        height: 150px;
    }
</style>
@stop

@section('content')

<div class="wikiSubjects">
    <div class="wikiSubjectsWrap">
        <h1>wikis</h1>
        @if (!count($wikiSubjects))
        <p>空空如也~</p>
        @else
        <div class="cards cards-borderless">
            <?php $i = 0; ?>
            @foreach ($wikiSubjects as $wikiSubject)
            <div class="col-md-4 col-sm-6 col-lg-3">
                <div class="card wikiSubjectsCard">
                    <a class="card" href="{{ route('wikis.show', ['id' => $wikiSubject->id]) }}">
                        <div class="media-wrapper">
                            <img src="{{ static_url($wikiSubject->cover) }}" alt="">
                        </div>
                        <div class="caption">{{ $wikiSubject->desc }}</div>
                        <div class="card-heading"><strong>{{ $wikiSubject->name }}</strong></div>
                        <!-- <div class="card-content text-muted">{{ $wikiSubject->desc }}</div> -->
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@stop