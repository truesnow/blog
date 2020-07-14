<div class="row">
    <div class="col-md-1">
        <a href="{{ route('users.show', $message->user_id) }}">
            <img src="{{ $message->user->avatar('50') }}" alt="{{ $message->user->name }}">
        </a>
    </div>
    <div class="col-md-11">
        <div class="row">
            <div class="col-md-6">
                <h5> <a href="{{ route('users.show', $message->user_id) }}">{{ $message->user->name }}</a> </h5>
            </div>
            <div class="pull-right">
                <span class="text-right">
                    @can('destroy', $message)
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" role="form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-sm btn-danger message-delete-btn">删除</button>
                        </form>
                    @endcan
                </span>
            </div>
        </div>
        <p>
            <span>{{ $message->created_at->diffForHumans() }}</span>
        </p>
        <p>{{ $message->content }}</p>
    </div>
</div>

<hr>