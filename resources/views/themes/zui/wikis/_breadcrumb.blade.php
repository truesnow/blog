<ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="icon icon-home"></i>首页</a></li>
    <li><a href="{{ route('wikis.index') }}">wiki</a></li>
    @if (isset($wikiSubject))
    <li><a href="{{ route('wikis.show', ['wikiSubject' => $wikiSubject->id]) }}">{{ $wikiSubject->name }}</a></li>
    @endif
    @if (isset($wikiCate))
    <li><a href="{{ route('wikis.items.index', ['wikiSubject' => $wikiSubject->id, 'wikiCate' => $wikiCate->id]) }}">{{ $wikiCate->name }}</a></li>
    @endif
    @if (isset($wikiItem))
    <li class="active">{{ $wikiItem->name }}</li>
    @endif
</ol>