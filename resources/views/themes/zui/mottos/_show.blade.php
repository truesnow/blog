@if (!empty($motto))

<div class="container-fluid motto-wrap">
    <div class="col-md-6 col-md-offset-3">
        <div class="text-center">
            <img src="{{ static_url($motto->portrait) }}" alt="{{ $motto->author }}" width="80px" height="80px" class="img img-circle">
        </div>
        <p class="text-left"><i class="icon icon-quote-left icon-2x"></i> {{ $motto->content }}</p>
        <h3 class="text-right">—— {{ $motto->author }} <small>{{ $motto->source }}</small></h3>
    </div>
</div>

@endif