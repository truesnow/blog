<?php

use Illuminate\Support\Arr;
?>

<ul class="nav nav-tabs with-padding">
    <li class="{{ active_class(if_route('wikis.show')) }}"><a href="{{ route('wikis.show', ['wikiSubject' => $wikiSubject->id]) }}">简介</a></li>
    @foreach ($wikiCates as $wikiCate)
    <?php $subjectCateUrl = route('wikis.items.index', ['wikiSubject' => $wikiSubject->id, 'wikiCate' => $wikiCate->id]); ?>
    <li class="{{ active_class(url()->current() == $subjectCateUrl) }}">
        <a href="{{ $subjectCateUrl }}">
            {{ $wikiCate->name }}
            <span class="label label-badge label-default">{{ Arr::get($cateToItemCountMap, $wikiCate->id, 0) }}</span>
        </a>
    </li>
    @endforeach
</ul>