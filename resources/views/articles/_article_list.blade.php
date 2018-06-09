<div class="articles">
    @if (count($articles))

        @foreach ($articles as $article)
        <div class="row article">
            <h2><a href="{{ $article->link() }}">{{ $article->title }}</a></h2>
            <div>
                <span>作者：<a href="{{ route('users.show', $article->user->id) }}">{{ $article->user->name }}</a></span>收录在 <a href="{{ route('subjects.show', $article->subject->id) }}">{{ $article->subject->name }}</a>, {{ $article->created_at->diffForHumans() }}, {{ $article->view_count }} 阅读, {{ $article->reply_count }} 评论
            </div>
            <p>{{ $article->excerpt }}</p>
        </div>
        @endforeach

    @else
       <div class="empty-block">暂无文章 ~_~ </div>
    @endif
</div>