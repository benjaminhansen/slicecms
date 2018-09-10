@if(view()->exists('theme::404'))
    @include('theme::404')
@else
    @include('slice404')
@endif
