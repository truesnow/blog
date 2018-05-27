<div class="row">
    <div class="col-md-1">
        <a href="{{ route('users.show', $message->user_id) }}">
            <img src="{{ $message->user->avatar('50') }}" alt="{{ $message->user->name }}">
        </a>
    </div>
    <div class="col-md-11">
        <h5><a href="{{ route('users.show', $message->user_id) }}">{{ $message->user->name }}</a></h5>
        <p>
            <span>{{ $message->created_at->diffForHumans() }}</span>
        </p>
        <p>{{ $message->content }}</p>
    </div>
</div>

<hr>