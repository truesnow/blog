@foreach ($subjects as $k => $subject)
    @if (($k + 1) % 3 == 1)
        <div class="row subjects">
    @endif
        <div class="col-md-4 text-center subject">
            <h2><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a></h2>
            <p>{{ $subject->description }}</p>
            <p>共{{ $subject->article_count }}篇文章</p>
        </div>
    @if (($k + 1) % 3 == 0)
        </div>
    @endif
@endforeach