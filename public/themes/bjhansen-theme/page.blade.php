@include('theme::header')

<div class="container">
    <h2 class="page-title">{{ $slice->title }}</h2>
    {!! $slice->content !!}
</div>

@include('theme::footer')
