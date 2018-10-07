<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">{{ site()->name }}</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
          @include(bootstrapNav(), ['items' => $slice_navigation->roots()])
      </ul>
      <!--
      @include(defaultNav(), $data = ['class' => 'nav navbar-nav navbar-left'])
      -->
    </div><!--/.nav-collapse -->
  </div>
</nav>
