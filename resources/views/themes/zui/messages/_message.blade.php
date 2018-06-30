<div class="comment">
  <img src="{{ $message->user->avatar('40') }}" alt="{{ $message->user->name }}" class="avatar">
   <div class="content">
    <div class="pull-right text-muted">{{ $message->created_at->diffForHumans() }}</div>
    <div> <strong>{{ $message->user->name }}</strong> </div>
    <div class="text">{{ $message->content }}</div>
    <div class="actions">
        @can('destroy', $message)
            <form action="{{ route('messages.destroy', $message->id) }}" method="POST" role="form">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-sm btn-danger message-delete-btn">删除</button>
            </form>
        @endcan
    </div>
  </div>
</div>

