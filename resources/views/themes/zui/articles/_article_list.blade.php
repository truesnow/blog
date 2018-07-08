<div class="list article-wrap">
  <header>
    <h3><i class="icon-list-ul"></i> 文章 <small>共 {{ $article_count }} 篇</small></h3>
  </header>
  <div class="items items-hover">
    @if (count($articles))

        @foreach ($articles as $article)
        <div class="items">
          <div class="item">
            <div class="item-heading">
              <h4><a href="{{ $article->link() }}">{{ $article->title }}</a></h4>
            </div>
            <!-- <div class="item-content">{{ $article->excerpt }}</div> -->
            <div class="item-footer">
              <!-- <a href="{{ route('subjects.show', $article->subject->id) }}"><i class="icon-archive"></i>{{ $article->subject->name }}</a> &nbsp; -->
              <!-- <span class="text-muted"><i class="icon-eye-open"></i> {{ $article->view_count }}</span> &nbsp; -->
              <!-- <span class="text-muted"><i class="icon-comments"></i> {{ $article->reply_count }}</span> &nbsp; -->
              <!-- <span class="text-muted">{{ $article->created_at->diffForHumans() }}</span> -->
            </div>
          </div>
        </div>
        @endforeach

    @else
       <div class="empty-block">暂无文章 ~_~ </div>
    @endif
  </div>
  <footer>
    {!! $articles->appends(Request::except('page'))->render() !!}
  </footer>
</div>