<div class="articles">
    @if (count($articles))

        @foreach ($articles as $article)
        <div class="row article">
            <h2><a href="{{ $article->link() }}">{{ $article->title }}</a></h2>
            <div class="article-info">
                <span>作者<a href="{{ route('users.show', $article->user->id) }}">{{ $article->user->name }}</a></span>
                <span>收录在 <a href="{{ route('subjects.show', $article->subject->id) }}">{{ $article->subject->name }}</a></span>
                <span>{{ $article->created_at->diffForHumans() }}</span>
                <span>{{ $article->view_count }} 阅读</span>
                <span>{{ $article->reply_count }} 评论</span>
            </div>
            <p>{{ $article->excerpt }}</p>
        </div>
        @endforeach

    @else
       <div class="empty-block">暂无文章 ~_~ </div>
    @endif
</div>