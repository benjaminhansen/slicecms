@include('theme::header')

<div class="container">
    <h2 class="page-title">{{ $exception->getMessage() }}</h2>
    <p>The page you requested could not be found.</p>
    <p><a href="{{ url('/') }}">Click here</a> to return to our homepage.</p>
</div>

@include('theme::footer')
