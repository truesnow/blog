<div class="row">
    <h2>{{ $subject->name }}</h2>
    <p>{{ $subject->description }}</p>
    <p>当前共有 {{ $subject->article_count }} 篇文章</p>
</div>

@foreach ($articles as $article)
<div class="row">
    <h2><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h2>
    <div>
        {{ $article->created_at->diffForHumans() }}, {{ $article->view_count }} 阅读, {{ $article->reply_count }} 评论
    </div>
    <p>{{ $article->excerpt }}</p>
</div>
@endforeach
{!! $articles->render() !!}