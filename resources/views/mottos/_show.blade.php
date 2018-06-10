<div class="media">
    <div class="media-left">
        <img src="{{ $motto->portrait }}" alt="{{ $motto->author }}" class="img img-circle">
    </div>
    <div class="media-body">
        <h4 class="media-heading">{{ $motto->source }} <small>{{ $motto->author }}</small></h4>
        <p>{{ $motto->content }}</p>
    </div>
</div>