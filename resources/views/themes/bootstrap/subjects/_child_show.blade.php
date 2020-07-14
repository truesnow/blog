<div class="row">
    <h2>{{ $subject->name }}</h2>
    <p>{{ $subject->description }}</p>
    <p>{{ $subject->article_count }} 篇文章</p>
</div>

@include('themes.bootstrap.articles._article_list', compact('articles'))