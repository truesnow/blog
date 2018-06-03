<div class="row">
    <h2>{{ $subject->name }}</h2>
    <p>{{ $subject->description }}</p>
    <p>当前共有 {{ $subject->article_count }} 篇文章</p>
</div>

@include('articles._article_list', compact('articles'))