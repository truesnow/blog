<div class="row">
    <h2>{{ $subject->name }}</h2>
    <p>{{ $subject->description }}</p>
</div>

<div class="row">
    <?php $subjects = $child_subjects; ?>
    @include('themes.bootstrap.subjects._list')
</div>