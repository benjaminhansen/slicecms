<script>window.Slice = {!! json_encode(['url' => url('/'), 'csrf_token' => csrf_token() ]) !!};</script>

@if(auth()->check())
    <link rel="stylesheet" href="{{ mix('js/app.js') }}">
    <script src="{{ mix('css/app.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endif
