<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <title>{{ $title }} - Slice CMS</title>

        <script>
            window.Laravel = {!! json_encode(['url' => url('/')]) !!};
        </script>

        @yield('head')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
              <a class="navbar-brand" href="#">Slice CMS</a>
              @if(auth()->check())
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="avatar avatar-inline" style="background-image:url('{{ auth()->user()->avatar_url }}');"></span>
                            {{ auth()->user()->fname }} {{ auth()->user()->lname }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('control/profile') }}"><span class="fa fa-cogs"></span> My Profile</a>
                            <a class="dropdown-item" href="{{ url('logout') }}"><span class="fa fa-sign-out"></span> Logout</a>
                        </div>
                      </li>
                    </ul>
                  </div>
              @endif
            </nav>

            <main role="main" class="container-fluid">
                <h2 class="page-title">{{ $title }}</h2>

                <span class="msg-area">{!! message() !!}</span>

                @yield('content')
            </main>

            <footer class="container-fluid" role="footer">
                <hr />
                <h6>&copy;{{ date("Y") }} Benjamin Hansen. All Rights Reserved.</h6>
            </footer>
        </div><!--#app-->

        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/slice.js') }}"></script>
        @yield('foot')
    </body>
</html>
