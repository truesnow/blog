<div class="comments">
  <header>
    @if (Auth::check())
    <div class="pull-right"><a href="#commentReplyForm2" class="btn btn-primary"><i class="icon-comment-alt"></i> 发表评论</a></div>
    @else
    <div class="pull-right"><a href="{{ route('login') }}" class="btn btn-primary"><i class="icon-user"></i> 请先登录</a></div>
    @endif
    <h3>所有评论（{{ count($replies) }}）</h3>
  </header>

  <section class="comments-list">
    @if (count($replies) > 0)
    @foreach ($replies as $index => $reply)
    <div class="comment">
      <a href="{{ route('users.show', [$reply->user_id]) }}" class="avatar">
        <img class="media-object img-thumbnail" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar() }}"  width="40px" height="40px" />
      </a>
      <div class="content">
        <div class="pull-right text-muted" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</div>
        <div><strong>{{ $reply->user->name }}</strong></div>
        <div class="text">{!! $reply->content !!}</div>
        <div class="actions">
          {{-- 回复删除按钮 --}}
          @can('destroy', $reply)
              <form action="{{ route('replies.destroy', $reply->id) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-link">删除</button>
              </form>
          @endcan
        </div>
      </div>
    </div>
    @endforeach
    @else
    <p class="text-center">暂无评论~_~</p>
    @endif
  </section>
  <footer>
    <div class="reply-form" id="commentReplyForm2">

      @if (Auth::check())

      <a href="###" class="avatar"><img src="{{ Auth::user()->avatar() }}" alt="{{ Auth::user()->name }}" width="40px" height="40px"></a>
      <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8" class="form">
        {{ csrf_field() }}
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <div class="form-group">
            <textarea name="content" id="content" rows="3" class="form-control new-comment-text" placeholder="撰写评论..."></textarea>
        </div>
        <div class="form-group comment-user">
          <div class="row">
            <div class="col-md-2 pull-right"><button type="submit" class="btn btn-block btn-primary"><i class="icon-ok"></i></button></div>
          </div>
        </div>
      </form>

      @else

      <div class="well well-sm text-center">
          <a href="{{ route('login') }}" class="btn btn-primary">请先登录</a>
      </div>

      @endif
    </div>
  </footer>
</div>
