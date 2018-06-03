@foreach (['danger', 'warning', 'success', 'info', 'message'] as $msg)

    @if (session()->get($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get($msg) }}
            </p>
        </div>
    @endif

@endforeach