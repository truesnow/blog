@if (Auth::check())

<div class="reply-box">
    @include('shares._errors')
    <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <div class="form-group">
            <textarea name="content" id="content" rows="3" class="form-control" placeholder="分享你的想法"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i>回复</button>
    </form>
</div>

@else

<div class="well well-sm text-center">
    <a href="{{ route('login') }}" class="btn btn-primary">请先登录</a>
</div>

@endif

<hr>
